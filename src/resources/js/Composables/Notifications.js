import axios from 'axios';
import { usePage } from '@inertiajs/inertia-vue3';
import { computed, ref } from 'vue';

export const useNotifications = () => {
  const user = computed(() => usePage().props.value.auth.user);

  const notifications = ref([]);
  const notificationsTotal = ref(0);
  const notification = ref({});
  const errors = ref('');

  const getNotifications = async ({}) => {
    const response = await axios.get(
      `/api/notifications?user_id=${user.value.id}`
    );

    notifications.value = response.data.data;
    notificationsTotal.value = response.data.total;
  };

  const getNotification = async (id) => {
    const response = await axios.get(`/api/notifications/${id}`);
    notification.value = response.data.data;
  };

  const storeNotification = async (data) => {
    errors.value = '';
    try {
      await axios.post('/api/notifications', {
        ...data,
        user_id: user.value.id
      });
    } catch (e) {
      if (e.response.status === 422) {
        errors.value = e.response.data.errors;
      }
    }
  };

  const destroyNotification = async (id) => {
    await axios.delete(`/api/notifications/${id}`);
  };

  return {
    notifications,
    notificationsTotal,
    notification,
    errors,
    getNotifications,
    getNotification,
    storeNotification,
    destroyNotification
  };
};
