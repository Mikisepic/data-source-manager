import axios from 'axios';
import { usePage } from '@inertiajs/inertia-vue3';
import { computed, ref } from 'vue';

export const useDataSources = () => {
  const user = computed(() => usePage().props.value.auth.user);

  const dataSources = ref([]);
  const dataSource = ref({});
  const dataSourceMeta = ref({});
  const errors = ref('');

  const getDataSources = async ({ collectionId, groupId }) => {
    const response = await axios.get(
      `/api/data_sources${window.location.search || '?page=1'}&user_id=${
        user.value.id
      }&collection_id=${collectionId || ''}&group_id=${groupId || ''}`
    );

    dataSources.value = response.data.data;
    dataSourceMeta.value = response.data.meta;
  };

  const getDataSource = async (id) => {
    const response = await axios.get(`/api/data_sources/${id}`);
    dataSource.value = response.data.data;
  };

  const storeDataSource = async (data) => {
    errors.value = '';
    try {
      await axios.post('/api/data_sources', {
        ...data,
        user_id: user.value.id
      });
    } catch (e) {
      if (e.response.status === 422) {
        errors.value = e.response.data.errors;
      }
    }
  };

  const updateDataSource = async (id, source = dataSource.value) => {
    errors.value = '';
    try {
      await axios.put(`/api/data_sources/${id}`, {
        ...source.value,
        user_id: user.value.id
      });
    } catch (e) {
      if (e.response.status === 422) {
        errors.value = e.response.data.errors;
      }
    }
  };

  const destroyDataSource = async (id) => {
    await axios.delete(`/api/data_sources/${id}`);
  };

  return {
    dataSources,
    dataSource,
    dataSourceMeta,
    errors,
    getDataSources,
    getDataSource,
    storeDataSource,
    updateDataSource,
    destroyDataSource
  };
};
