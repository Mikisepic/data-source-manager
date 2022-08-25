import axios from 'axios';
import { usePage } from '@inertiajs/inertia-vue3';
import { computed, ref } from 'vue';

export const useDataSources = () => {
  const dataSources = ref([]);
  const dataSource = ref([]);
  const dataSourceMeta = ref({});
  const dataSourceLinks = ref({});
  const errors = ref('');

  const getDataSources = async () => {
    const user = computed(() => usePage().props.value.auth.user);
    const response = await axios.get(
      `/api/data_sources${window.location.search}&user_id=${user.value.id}`
    );

    dataSources.value = response.data.data;
    dataSourceMeta.value = response.data.meta;
    dataSourceLinks.value = response.data.links;
  };

  const getDataSource = async (id) => {
    const response = await axios.get(`/api/data_sources/${id}`);
    dataSource.value = response.data.data;
  };

  const storeDataSource = async (data) => {
    errors.value = '';
    try {
      await axios.post('/api/data_sources', data);
    } catch (e) {
      if (e.response.status === 422) {
        errors.value = e.response.data.errors;
      }
    }
  };

  const updateDataSource = async (id) => {
    errors.value = '';
    try {
      await axios.put(`/api/data_sources/${id}`, dataSource.value);
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
    dataSourceLinks,
    errors,
    getDataSources,
    getDataSource,
    storeDataSource,
    updateDataSource,
    destroyDataSource
  };
};
