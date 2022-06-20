import axios from 'axios';

import { ref } from 'vue';
import { useRouter } from 'vue-router';

export default function useGroups() {
  const groups = ref([]);
  const group = ref([]);
  const errors = ref('');

  const router = useRouter();

  const getGroups = async () => {
    let response = await axios.get('/api/groups');
    groups.value = response.data.data;
  };

  const getGroup = async (id) => {
    let response = await axios.get('/api/groups/' + id);
    group.value = response.data.data;
  };

  const storeGroup = async (data) => {
    errors.value = '';
    try {
      await axios.post('/api/groups', data);
      await router.push({ name: 'groups' });
    } catch (e) {
      if (e.response.status === 422) {
        errors.value = e.response.data.errors;
      }
    }
  };

  const updateGroup = async (id) => {
    errors.value = '';
    try {
      await axios.put('/api/groups/' + id, group.value);
      await router.push({ name: 'groups' });
    } catch (e) {
      if (e.response.status === 422) {
        errors.value = e.response.data.errors;
      }
    }
  };

  const destroyGroup = async (id) => {
    await axios.delete('/api/groups/' + id);
  };

  return {
    groups,
    group,
    errors,
    getGroups,
    getGroup,
    storeGroup,
    updateGroup,
    destroyGroup
  };
}
