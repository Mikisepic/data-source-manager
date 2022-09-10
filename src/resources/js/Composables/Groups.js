import axios from 'axios';
import { usePage } from '@inertiajs/inertia-vue3';
import { computed, ref } from 'vue';

export const useGroups = () => {
  const groups = ref([]);
  const group = ref({});
  const groupMeta = ref({});
  const errors = ref('');

  const getGroups = async () => {
    const user = computed(() => usePage().props.value.auth.user);
    const response = await axios.get(
      `/api/groups${window.location.search || '?page=1'}&user_id=${
        user.value.id
      }`
    );

    groups.value = response.data.data;
    groupMeta.value = response.data.meta;
    groupLinks.value = response.data.links;
  };

  const getGroup = async (id) => {
    const response = await axios.get(`/api/groups/${id}`);
    group.value = response.data.data;
  };

  const storeGroup = async (data) => {
    errors.value = '';
    try {
      await axios.post('/api/groups', data);
    } catch (e) {
      if (e.response.status === 422) {
        errors.value = e.response.data.errors;
      }
    }
  };

  const updateGroup = async (id) => {
    errors.value = '';
    try {
      await axios.put(`/api/groups/${id}`, group.value);
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
        dataSourceId,
        isRemove
      });
    } catch (e) {
      if (e.response.status === 422) {
        errors.value = e.response.data.errors;
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
    storeGroup,
    updateGroup,
    addOrRemoveDataSourceToGroup,
    destroyGroup
  };
};
