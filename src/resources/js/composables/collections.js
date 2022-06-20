import axios from 'axios';

import { ref } from 'vue';
import { useRouter } from 'vue-router';

export default function useCollections() {
  const collections = ref([]);
  const collection = ref([]);
  const errors = ref('');

  const router = useRouter();

  const getCollections = async () => {
    let response = await axios.get('/api/collections');
    collections.value = response.data.data;
  };

  const getCollection = async (id) => {
    let response = await axios.get('/api/collections/' + id);
    collection.value = response.data.data;
  };

  const storeCollection = async (data) => {
    errors.value = '';
    try {
      await axios.post('/api/collections', data);
      await router.push({ name: 'collections' });
    } catch (e) {
      if (e.response.status === 422) {
        errors.value = e.response.data.errors;
      }
    }
  };

  const updateCollection = async (id) => {
    errors.value = '';
    try {
      await axios.put('/api/collections/' + id, collection.value);
      await router.push({ name: 'collections' });
    } catch (e) {
      if (e.response.status === 422) {
        errors.value = e.response.data.errors;
      }
    }
  };

  const destroyCollection = async (id) => {
    await axios.delete('/api/collections/' + id);
  };

  return {
    collections,
    collection,
    errors,
    getCollections,
    getCollection,
    storeCollection,
    updateCollection,
    destroyCollection
  };
}
