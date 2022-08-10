import axios from 'axios';

import { ref } from 'vue';
import { useRouter } from 'vue-router';

export default function useReferences() {
  const references = ref([]);
  const reference = ref([]);
  const collections = ref([]);
  const errors = ref('');

  const router = useRouter();

  const getReferences = async () => {
    let response = await axios.get('/api/references');
    references.value = response.data.data;
  };

  const getCollections = async () => {
    let response = await axios.get('/api/collections');
    collections.value = response.data.data;
  };

  const getReference = async (id) => {
    let response = await axios.get('/api/references/' + id);
    reference.value = response.data.data;
  };

  const storeReference = async (data) => {
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

  const updateReference = async (id) => {
    errors.value = '';
    try {
      await axios.put('/api/references/' + id, reference.value);
      await router.push({ name: 'library' });
    } catch (e) {
      if (e.response.status === 422) {
        errors.value = e.response.data.errors;
      }
    }
  };

  const destroyReference = async (id) => {
    await axios.delete('/api/references/' + id);
  };

  return {
    references,
    reference,
    collections,
    errors,
    getReferences,
    getCollections,
    getReference,
    storeReference,
    updateReference,
    destroyReference
  };
}
