<script setup>
import {
  PlusIcon,
  TrashIcon,
  PencilSquareIcon,
  EyeIcon
} from '@heroicons/vue/24/outline';
import { usePage } from '@inertiajs/inertia-vue3';
import { computed, onMounted, reactive, ref } from '@vue/runtime-core';

import { useCollections } from '@/Composables/Collections';
import { useNotifications } from '@/Composables/Notifications';

const url = new URL(window.location);
const collectionId = url.pathname.split('/')[2];

const isOpen = ref(false);
const openCreateDialog = ref(false);
const openPreviewDialog = computed(
  () => usePage().props.value.openPreviewDialog
);
const openDeleteConfirmationDialog = computed(
  () => usePage().props.value.openDeleteConfirmationDialog
);

const form = reactive({
  title: '',
  description: ''
});

const { storeNotification } = useNotifications();

const pushNotification = async (info) => {
  await storeNotification({ ...info });
};

const {
  collection,
  collections,
  collectionMeta,
  errors,
  getCollections,
  getCollection,
  storeCollection,
  updateCollection,
  destroyCollection
} = useCollections();

const createCollection = async () => {
  await storeCollection({ ...form });

  if (!!!errors.value) {
    pushNotification({
      type: 'create',
      title: 'Collection Created',
      body: `Collection <span class="font-extrabold">${form.title}</span> has been created`
    });

    closeModal();
  }
};

const saveCollection = async () => {
  await updateCollection(collectionId);

  if (!!!errors.value) {
    pushNotification({
      type: 'update',
      title: 'Collection Updated',
      body: `Collection <span class="font-extrabold">${collection.value.title}</span> has been updated`
    });

    closeModal();
  }
};

const deleteCollection = async () => {
  await destroyCollection(collectionId);

  if (!!!errors.value) {
    pushNotification({
      type: 'delete',
      title: 'Collection Deleted',
      body: `Collection <span class="font-extrabold">${collection.value.title}</span> has been deleted`
    });

    closeModal();
  }
};

onMounted(() => {
  getCollections({});

  if (openPreviewDialog.value || openDeleteConfirmationDialog.value) {
    getCollection(collectionId);
    isOpen.value = true;
  }
});

const resetFormValues = () => {
  form.title = '';
  form.description = '';
};

const closeModal = () => {
  isOpen.value = false;
  openCreateDialog.value = false;

  resetFormValues();
  getCollections({});
};
</script>
<template>
  <AuthenticatedLayout>
    <Head title="Collections" />

    <template #header>Collections</template>

    <div class="flex items-center justify-end mb-4">
      <Button
        type="button"
        :rounded="true"
        @click="
          () => {
            isOpen = true;
            openCreateDialog = true;
          }
        "
      >
        <PlusIcon class="w-5 h-5" />
      </Button>
    </div>

    <div v-if="collectionMeta.total > 0">
      <div class="flex justify-center flex-wrap w-full gap-10">
        <div
          v-for="collection in collections"
          v-bind:key="collection.id"
          class="collection block divide-y divide-gray-100 p-6 max-w-xs bg-white rounded-lg border border-gray-400 shadow-md hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-800 dark:hover:bg-gray-600 dark:divide-gray-600"
        >
          <Link :href="route('collectionShow', collection.id)">
            <h5
              class="mb-2 text-2xl h-20 overflow-hidden break-all text-ellipsis font-bold tracking-tight text-gray-900 dark:text-white"
            >
              {{ collection.title }}
            </h5>

            <div class="flex justify-between mb-2">
              <h5
                class="mb-2 w-[150px] text-md font-bold tracking-tight text-gray-900 dark:text-white"
              >
                Total Data Sources
              </h5>
              <span
                class="font-normal text-sm text-gray-700 dark:text-gray-400 break-all"
              >
                {{ collection.data_sources_count }}
              </span>
            </div>

            <div class="flex justify-between mb-2">
              <h5
                class="mb-2 w-[150px] text-md font-bold tracking-tight text-gray-900 dark:text-white"
              >
                Last Updated
              </h5>
              <span
                class="font-normal text-right text-sm text-gray-700 dark:text-gray-400 break-all"
                v-html="$dateDifference(collection.updated_at)"
              >
              </span>
            </div>
          </Link>
          <div class="text-gray-700 dark:text-white flex justify-evenly pt-3">
            <Link :href="route('collectionPreview', collection.id)">
              <PencilSquareIcon class="h-7 w-7" />
            </Link>

            <Link :href="route('collectionShow', collection.id)">
              <EyeIcon class="h-7 w-7" />
            </Link>

            <Link :href="route('collectionDelete', collection.id)">
              <TrashIcon
                class="h-7 w-7 text-red-700 hover:text-red-800 dark:text-red-600 dark:hover:text-red-700"
              />
            </Link>
          </div>
        </div>
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
        You currently have no instances of this type. Feel free to create one,
        or two...
      </p>
      <div class="w-full inline-flex justify-end items-center">
        <Button
          type="button"
          class="py-3 px-5 text-base font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800"
          @click="() => (openCreateDialog = true)"
        >
          Create an instance
        </Button>
      </div>
    </div>

    <SharedDialog
      :isOpen="isOpen && openCreateDialog"
      goBackTo="collectionIndex"
      @closeDialog="closeModal"
    >
      <template #title>Add a New Collection</template>

      <form class="mt-2" @submit.prevent="createCollection">
        <div>
          <Label for="title" value="Title" />
          <Input
            id="title"
            type="text"
            class="mt-1 block w-full"
            v-model="form.title"
          />
          <InputError
            v-if="!!errors.title"
            class="mt-2"
            :message="errors.title[0]"
          />
        </div>

        <div class="mt-4">
          <Label for="description" value="Description" />
          <Input
            id="description"
            type="text"
            class="mt-1 block w-full"
            v-model="form.description"
          />
          <InputError
            v-if="!!errors.description"
            class="mt-2"
            :message="errors.description[0]"
          />
        </div>

        <div class="flex items-center justify-end mt-4 gap-5">
          <Button
            @click="closeModal"
            type="button"
            class="inline-flex justify-center rounded-md border border-transparent bg-blue-100 px-4 py-2 text-sm font-medium text-blue-900 hover:bg-blue-200 focus:outline-none focus-visible:ring-2 focus-visible:ring-blue-500 focus-visible:ring-offset-2"
          >
            Cancel
          </Button>
          <Button
            class="inline-flex justify-center rounded-md border border-transparent bg-blue-100 px-4 py-2 text-sm font-medium text-blue-900 hover:bg-blue-200 focus:outline-none focus-visible:ring-2 focus-visible:ring-blue-500 focus-visible:ring-offset-2"
          >
            Create
          </Button>
        </div>
      </form>
    </SharedDialog>

    <SharedDialog
      :isOpen="openPreviewDialog && isOpen"
      goBackTo="collectionIndex"
      @closeDialog="closeModal"
    >
      <template #title>Update Collection</template>

      <form class="mt-2" @submit.prevent="saveCollection">
        <div>
          <Label for="title" value="Title" />
          <Input
            id="title"
            type="text"
            class="mt-1 block w-full"
            v-model="collection.title"
          />
          <InputError
            v-if="!!errors.title"
            class="mt-2"
            :message="errors.title"
          />
        </div>

        <div class="mt-4">
          <Label for="description" value="Description" />
          <Input
            id="description"
            type="text"
            class="mt-1 block w-full"
            v-model="collection.description"
          />
          <InputError
            v-if="!!errors.description"
            class="mt-2"
            :message="errors.description[0]"
          />
        </div>

        <div class="flex items-center justify-end mt-4 gap-5">
          <Link :href="route('collectionIndex')" @click="closeModal">
            <Button
              class="inline-flex justify-center rounded-md border border-transparent bg-blue-100 px-4 py-2 text-sm font-medium text-blue-900 hover:bg-blue-200 focus:outline-none focus-visible:ring-2 focus-visible:ring-blue-500 focus-visible:ring-offset-2"
            >
              Cancel
            </Button>
          </Link>
          <Link :href="route('collectionIndex')" @click="saveCollection">
            <Button
              class="inline-flex justify-center rounded-md border border-transparent bg-blue-100 px-4 py-2 text-sm font-medium text-blue-900 hover:bg-blue-200 focus:outline-none focus-visible:ring-2 focus-visible:ring-blue-500 focus-visible:ring-offset-2"
            >
              Save
            </Button>
          </Link>
        </div>
      </form>
    </SharedDialog>

    <SharedDialog
      :isOpen="openDeleteConfirmationDialog && isOpen"
      goBackTo="collectionIndex"
      @closeDialog="closeModal"
    >
      <template #title
        >Are you sure you want to Delete this Collection?</template
      >

      <div class="flex items-center justify-end mt-4 gap-5">
        <Link :href="route('collectionIndex')" @click="closeModal">
          <Button
            class="inline-flex justify-center rounded-md border border-transparent bg-blue-100 px-4 py-2 text-sm font-medium text-blue-900 hover:bg-blue-200 focus:outline-none focus-visible:ring-2 focus-visible:ring-blue-500 focus-visible:ring-offset-2"
          >
            Cancel
          </Button>
        </Link>
        <Link :href="route('collectionIndex')" @click="deleteCollection">
          <Button
            class="inline-flex justify-center rounded-md border border-transparent text-red-700 hover:text-white border border-red-700 hover:bg-red-800 dark:border-red-500 dark:text-red-500 dark:hover:text-white dark:hover:bg-red-600"
          >
            Yes, delete
          </Button>
        </Link>
      </div>
    </SharedDialog>
  </AuthenticatedLayout>
</template>
<style scoped>
.collection {
  max-width: 250px;
}
</style>
