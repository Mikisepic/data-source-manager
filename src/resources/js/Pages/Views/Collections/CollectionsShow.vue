<script setup>
import { ChevronDoubleDownIcon, XMarkIcon } from '@heroicons/vue/24/outline';
import { usePage } from '@inertiajs/inertia-vue3';
import { computed, onMounted, ref } from '@vue/runtime-core';

import { useDataSources } from '@/Composables/DataSources';
import { useCollections } from '@/Composables/Collections';
import { useNotifications } from '@/Composables/Notifications';

const url = new URL(window.location);
const collectionId = url.pathname.split('/')[2];
const dataSourceId = url.pathname.split('/')[4];

const isOpen = ref(true);
const openRemoveFromCollectionDialog = computed(
  () => usePage().props.value.openRemoveFromCollectionDialog
);

const { storeNotification } = useNotifications();

const pushNotification = async (info) => {
  await storeNotification({ ...info });
};

const { collection, getCollection, addOrRemoveDataSourceToCollection } =
  useCollections();

const saveCollection = async () => {
  await addOrRemoveDataSourceToCollection(collection, dataSourceId, true);

  pushNotification({
    type: 'remove_instance',
    title: 'Data Source Removed from a Collection',
    body: `Data Source <span class="font-extrabold">${dataSource.value.title}</span> has been removed from <span class="font-extrabold">${collection.value.title}</span>`
  });

  closeModal();
};

const {
  dataSource,
  dataSources,
  dataSourceMeta,
  getDataSources,
  getDataSource
} = useDataSources();

onMounted(() => {
  getDataSources({ collectionId });
  getCollection(collectionId);

  if (openRemoveFromCollectionDialog.value) {
    getDataSource(dataSourceId);
  }
});

const closeModal = () => {
  isOpen.value = false;
};
</script>

<template>
  <AuthenticatedLayout>
    <Head title="Preview Collection" />

    <template #header>Preview Collection</template>

    <div
      v-if="dataSourceMeta.total > 0"
      class="overflow-x-auto sm:-mx-6 lg:-mx-8"
    >
      <div class="py-2 inline-block min-w-full sm:px-6 lg:px-8">
        <table
          class="min-w-full table-fixed text-center text-gray-500 dark:text-gray-400"
        >
          <thead
            class="text-sm text-gray-700 uppercase font-bold bg-gray-50 dark:bg-gray-600 dark:text-gray-300"
          >
            <tr>
              <th scope="col" class="px-6 py-4 border-r w-15">Title</th>
              <th scope="col" class="px-6 py-4 border-r w-20">Author</th>
              <th scope="col" class="px-6 py-4 border-r w-10">Category</th>
              <th scope="col" class="px-6 py-4 border-r">Created At</th>
              <th scope="col" class="px-6 py-4 border-r">Expires At</th>
              <th scope="col" class="px-6 py-4 w-10">Actions</th>
            </tr>
          </thead>
          <tbody>
            <tr
              :class="
                index % 2 === 0
                  ? 'bg-white dark:bg-gray-900'
                  : 'bg-gray-50  dark:bg-gray-800'
              "
              class="border-b dark:border-gray-700"
              v-for="(source, index) in dataSources"
              v-bind:key="source.id"
            >
              <td
                class="font-medium text-left text-gray-900 px-6 py-4 text-ellipsis overflow-hidden whitespace-nowrap dark:text-white border-r"
              >
                <Link :href="source.source">
                  {{ source.title }}
                </Link>
              </td>
              <td class="text-sm font-light px-6 py-4 break-all border-r">
                {{ source.author }}
              </td>
              <td
                class="text-sm font-light px-6 py-4 whitespace-nowrap border-r"
              >
                {{ $titlecase(source.category) }}
              </td>
              <td
                class="text-sm font-light px-6 py-4 whitespace-nowrap border-r"
              >
                {{ new Date(source.created_at).toDateString() }}
              </td>
              <td
                class="text-sm font-light px-6 py-4 whitespace-nowrap border-r"
              >
                {{ new Date(source.expires_at).toDateString() }}
              </td>
              <td class="px-6 py-4 flex justify-center whitespace-nowrap">
                <Link
                  class="text-md text-red-700 hover:text-red-800 dark:text-red-600 dark:hover:text-red-700"
                  :href="
                    route('collectionRemoveFromCollection', {
                      id: collectionId,
                      dataSourceId: source.id
                    })
                  "
                >
                  <XMarkIcon class="h-5 w-5"
                /></Link>
              </td>
            </tr>
          </tbody>
        </table>
      </div>

      <Pagination
        :meta="{
          from: dataSourceMeta.from,
          to: dataSourceMeta.to,
          total: dataSourceMeta.total,
          current_page: dataSourceMeta.current_page,
          last_page: dataSourceMeta.last_page
        }"
        routeName="libraryIndex"
      />
    </div>

    <div v-else class="sm:px-16 xl:px-38">
      <h1
        class="mb-4 text-4xl font-extrabold tracking-tight text-gray-900 md:text-4xl lg:text-5xl dark:text-white"
      >
        Looks like there are no records here...
      </h1>
      <p
        class="mb-6 text-lg font-normal text-gray-500 lg:text-xl dark:text-gray-400"
      >
        There are no instances in this collection yet.
      </p>
    </div>

    <SharedDialog
      :isOpen="openRemoveFromCollectionDialog && isOpen"
      goBackTo="collectionShow"
      :goBackToId="collectionId"
      @closeDialog="closeModal"
    >
      <template #title>Remove Instance from Collection?</template>

      <div
        v-if="!!dataSource.id"
        class="flex items-center justify-end mt-4 gap-5"
      >
        <Link :href="route('collectionShow', collectionId)" @click="closeModal">
          <Button
            class="inline-flex justify-center rounded-md border border-transparent bg-blue-100 px-4 py-2 text-sm font-medium text-blue-900 hover:bg-blue-200 focus:outline-none focus-visible:ring-2 focus-visible:ring-blue-500 focus-visible:ring-offset-2"
          >
            No, not yet
          </Button>
        </Link>
        <Link
          :href="route('collectionShow', collectionId)"
          @click="saveCollection"
        >
          <Button
            class="inline-flex justify-center rounded-md border border-transparent text-red-700 hover:text-white border border-red-700 hover:bg-red-800 dark:border-red-500 dark:text-red-500 dark:hover:text-white dark:hover:bg-red-600"
          >
            Yes, remove
          </Button>
        </Link>
      </div>

      <div v-else>
        <h1
          class="mb-4 text-4xl font-extrabold tracking-tight leading-none text-gray-900 md:text-5xl lg:text-6xl dark:text-white"
        >
          Whoops!
        </h1>
        <p class="text-lg font-normal text-gray-500 dark:text-gray-400">
          Looks like this instance has been deleted!
        </p>
      </div>
    </SharedDialog>
  </AuthenticatedLayout>
</template>
