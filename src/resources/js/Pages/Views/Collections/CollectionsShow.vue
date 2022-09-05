<script setup>
import { useDataSources } from '@/Composables/DataSources';
import { onMounted } from '@vue/runtime-core';

const {
  dataSource,
  dataSources,
  dataSourceMeta,
  dataSourceLinks,
  errors,
  getDataSources,
  getDataSource,
  storeDataSource,
  updateDataSource,
  destroyDataSource
} = useDataSources();

const createDataSource = async () => {
  await storeDataSource({ ...form });
  getDataSources();

  if (!!!errors.value) {
    closeModal();
  }
};

const saveDataSource = async () => {
  await updateDataSource(dataSource.value.id);
};

const deleteDataSource = async (id) => {
  await destroyDataSource(id);
  await getDataSources();
};

onMounted(() => {
  const url = new URL(window.location);
  const collectionId = url.pathname.split('/')[2];
  getDataSources({ collectionId });
});
</script>

<template>
  <AuthenticatedLayout>
    <Head title="Collections" />

    <template #header>Collection Show</template>
  </AuthenticatedLayout>
</template>
