import axios from 'axios';
import { usePage } from '@inertiajs/inertia-vue3';
import { computed, ref } from 'vue';

export const useCollections = () => {
  const collections = ref([]);
  const collection = ref({});
  const collectionMeta = ref({});
  const collectionLinks = ref({});
  const errors = ref('');

  const getCollections = async () => {
    const user = computed(() => usePage().props.value.auth.user);
    const response = await axios.get(
      `/api/collections${window.location.search || '?page=1'}&user_id=${
        user.value.id
      }`
    );

    collections.value = response.data.data;
    collectionMeta.value = response.data.meta;
    collectionLinks.value = response.data.links;
  };

  const getCollection = async (id) => {
    const response = await axios.get(`/api/collections/${id}`);
    collection.value = response.data.data;
  };

  const storeCollection = async (data) => {
    errors.value = '';
    try {
      await axios.post('/api/collections', data);
    } catch (e) {
      if (e.response.status === 422) {
        errors.value = e.response.data.errors;
      }
    }
  };

  const updateCollection = async (id) => {
    errors.value = '';
    try {
      await axios.put(`/api/collections/${id}`, collection.value);
    } catch (e) {
      if (e.response.status === 422) {
        errors.value = e.response.data.errors;
      }
    }
  };

  const addDataSourceToCollection = async (
    selectedCollection,
    dataSourceId
  ) => {
    errors.value = '';
    try {
      await axios.put(`/api/collections/${selectedCollection.value.id}`, {
        ...selectedCollection.value,
        dataSourceId
      });
    } catch (e) {
      if (e.response.status === 422) {
        errors.value = e.response.data.errors;
      }
    }
  };

  const destroyCollection = async (id) => {
    await axios.delete(`/api/collections/${id}`);
  };

  return {
    collections,
    collection,
    collectionMeta,
    collectionLinks,
    errors,
    getCollections,
    getCollection,
    storeCollection,
    updateCollection,
    addDataSourceToCollection,
    destroyCollection
  };
};
