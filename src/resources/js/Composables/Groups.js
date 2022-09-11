import axios from 'axios';
import { usePage } from '@inertiajs/inertia-vue3';
import { computed, ref } from 'vue';

export const useGroups = () => {
  const user = computed(() => usePage().props.value.auth.user);

  const groups = ref([]);
  const group = ref({});
  const groupMeta = ref({});
  const groupUsersData = ref([]);
  const groupUsersTotal = ref(0);
  const errors = ref('');

  const getGroups = async ({}) => {
    const response = await axios.get(
      `/api/groups${window.location.search || '?page=1'}&user_id=${
        user.value.id
      }`
    );

    groups.value = response.data.data;
    groupMeta.value = response.data.meta;
  };

  const getGroup = async (id) => {
    const response = await axios.get(`/api/groups/${id}`);
    group.value = response.data.data;
  };

  const getGroupUsers = async (id) => {
    const response = await axios.get(`/api/groups/${id}/users`);
    groupUsersData.value = response.data.data;
    groupUsersTotal.value = response.data.total;
  };

  const storeGroup = async (data) => {
    errors.value = '';
    try {
      await axios.post('/api/groups', { ...data, user_id: user.value.id });
    } catch (e) {
      if (e.response.status === 422) {
        errors.value = e.response.data.errors;
      }
    }
  };

  const updateGroup = async (id) => {
    errors.value = '';
    try {
      await axios.put(`/api/groups/${id}`, {
        ...group.value,
        user_id: user.value.id
      });
    } catch (e) {
      if (e.response.status === 422) {
        errors.value = e.response.data.errors;
      }
    }
  };

  const addOrRemoveDataSourceToGroup = async (
    selectedGroup,
    dataSourceId,
    isRemove = false
  ) => {
    errors.value = '';
    try {
      await axios.put(`/api/groups/${selectedGroup.value.id}`, {
        ...selectedGroup.value,
        user_id: user.value.id,
        dataSourceId,
        isRemove
      });
    } catch (e) {
      if (e.response.status === 422) {
        errors.value = e.response.data.errors;
      }
    }
  };

  const addOrRemoveUserToGroup = async (
    groupId,
    memberUsername,
    isRemove = false
  ) => {
    errors.value = '';
    try {
      if (memberUsername === user.value.username)
        throw new Error('Cannot Remove Group Owner');

      if (
        groupUsersData.value.some(
          (groupUser) => groupUser.username === memberUsername
        ) &&
        !isRemove
      )
        throw new Error('This User is already in this group');

      await axios.put(`/api/groups/${groupId}`, {
        ...group.value,
        user_id: user.value.id,
        memberUsername,
        isRemove
      });
    } catch (e) {
      if (!!e.response && e.response.status === 422) {
        errors.value = e.response.data.errors;
      } else {
        errors.value = [e.message];
      }
    }
  };

  const destroyGroup = async (id) => {
    await axios.delete(`/api/groups/${id}`);
  };

  return {
    groups,
    group,
    groupMeta,
    errors,
    getGroups,
    getGroup,
    getGroupUsers,
    groupUsersData,
    groupUsersTotal,
    storeGroup,
    updateGroup,
    addOrRemoveDataSourceToGroup,
    addOrRemoveUserToGroup,
    destroyGroup
  };
};
