<script setup>
import { useCollections } from '@/Composables/Collections';
import { onMounted } from '@vue/runtime-core';

const {
  collection,
  collections,
  collectionMeta,
  collectionLinks,
  errors,
  getCollections,
  getCollection,
  storeCollection,
  destroyCollection
} = useCollections();

const saveCollection = async () => {
  await storeCollection({ ...form });
  getCollections();

  if (!!!errors.value) {
    closeModal();
  }
};

const deleteCollection = async (id) => {
  await destroyCollection(id);
  await getCollections();
};

onMounted(() => {
  getCollections();
});
</script>
<template>
  <AuthenticatedLayout>
    <Head title="Collections" />

    <template #header>
      <h2
        class="font-semibold text-xl text-gray-800 dark:text-white leading-tight"
      >
        Collections
      </h2>
    </template>

    <div class="flex flex-wrap w-full gap-10">
      <Link
        class="block p-6 max-w-xs bg-white rounded-lg border border-gray-200 shadow-md hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700"
        v-for="collection in collections"
        v-bind:key="collection.id"
        :href="route('collectionShow', collection.id)"
      >
        <h5
          class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white"
        >
          {{ collection.title }}
        </h5>
        <p class="font-normal text-gray-700 dark:text-gray-400">
          {{ collection.description }}
        </p>
      </Link>
    </div>

    <Pagination
      :meta="{
        from: collectionMeta.from,
        to: collectionMeta.to,
        total: collectionMeta.total,
        current_page: collectionMeta.current_page,
        last_page: collectionMeta.last_page
      }"
      routeName="collectionIndex"
    />
  </AuthenticatedLayout>
</template>
