import axios from 'axios';

import { ref } from 'vue';
import { useRouter } from 'vue-router';

export default function useUser() {
  const user = ref([]);
  const errors = ref('');

  const router = useRouter();

  const getUser = async (id) => {
    let response = await axios.get('/api/user/' + id);
    user.value = response.data.data;
  };

  const storeUser = async (data) => {
    errors.value = '';
    try {
      await axios.post('/api/user', data);
      await router.push({ name: 'settings' });
    } catch (e) {
      if (e.response.status === 422) {
        errors.value = e.response.data.errors;
      }
    }
  };

  const updateUser = async (id) => {
    errors.value = '';
    try {
      await axios.put('/api/user/' + id, user.value);
      await router.push({ name: 'settings' });
    } catch (e) {
      if (e.response.status === 422) {
        errors.value = e.response.data.errors;
      }
    }
  };

  const destroyUser = async (id) => {
    await axios.delete('/api/user/' + id);
  };

  return {
    user,
    getUser,
    storeUser,
    updateUser,
    destroyUser
  };
}
