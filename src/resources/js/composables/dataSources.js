import axios from 'axios';

import { ref } from 'vue';
import { useRouter } from 'vue-router';

export default function useDataSources() {
  const dataSources = ref([]);
  const dataSource = ref([]);
  const errors = ref('');

  const router = useRouter();

  const getDataSources = async () => {
    let response = await axios.get('/api/data_sources');
    dataSources.value = response.data.data;
  };

  const getDataSource = async (id) => {
    let response = await axios.get('/api/data_sources/' + id);
    dataSource.value = response.data.data;
  };

  const storeDataSource = async (data) => {
    errors.value = '';
    try {
      await axios.post('/api/references', data);
      await router.push({ name: 'library' });
    } catch (e) {
      if (e.response.status === 422) {
        errors.value = e.response.data.errors;
      }
    }
  };

  const updateDataSource = async (id) => {
    errors.value = '';
    try {
      await axios.put('/api/data_sources/' + id, dataSource.value);
      await router.push({ name: 'library' });
    } catch (e) {
      if (e.response.status === 422) {
        errors.value = e.response.data.errors;
      }
    }
  };

  const destroyDataSource = async (id) => {
    await axios.delete('/api/data_sources/' + id);
  };

  return {
    dataSources,
    dataSource,
    errors,
    getDataSources,
    getDataSource,
    storeDataSource,
    updateDataSource,
    destroyDataSource
  };
}
