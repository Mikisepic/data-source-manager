<script setup>
import { usePage } from '@inertiajs/inertia-vue3';
import { computed, onMounted, reactive, ref } from '@vue/runtime-core';
import {
  PlusIcon,
  TrashIcon,
  PencilSquareIcon,
  EyeIcon
} from '@heroicons/vue/24/outline';

import { useCollections } from '@/Composables/Collections';

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

const user = computed(() => usePage().props.value.auth.user);

const form = reactive({
  user_id: user.value.id,
  title: '',
  description: ''
});

const isOpen = ref(false);
const openModal = () => (isOpen.value = true);
const closeModal = () => {
  isOpen.value = false;
};
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

    <div class="flex items-center justify-end mb-4">
      <Button type="button" :rounded="true" @click="openModal">
        <PlusIcon class="w-5 h-5" />
      </Button>
    </div>

    <div v-if="collectionMeta.total > 0">
      <div class="flex flex-wrap w-full gap-10">
        <Link
          class="collection block divide-y divide-gray-100 p-6 max-w-xs bg-white rounded-lg border border-gray-200 shadow-md hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700 dark:divide-gray-600"
          v-for="collection in collections"
          v-bind:key="collection.id"
          :href="route('collectionShow', collection.id)"
        >
          <h5
            class="mb-2 text-2xl h-20 overflow-hidden break-all text-ellipsis font-bold tracking-tight text-gray-900 dark:text-white"
          >
            {{ collection.title }}
          </h5>

          <div class="flex justify-between">
            <h5
              class="mb-2 text-md font-bold tracking-tight text-gray-900 dark:text-white"
            >
              Last instance:
            </h5>
            <span
              class="font-normal w-20 h-20 overflow-hidden break-all text-ellipsis text-gray-700 dark:text-gray-400"
            >
              {{ collection.title }}
            </span>
          </div>

          <div class="flex justify-between">
            <h5
              class="mb-2 text-md font-bold tracking-tight text-gray-900 dark:text-white"
            >
              Last updated:
            </h5>
            <span
              class="font-normal w-20 text-gray-700 dark:text-gray-400 break-all"
            >
              {{ collection.updated_at }}
            </span>
          </div>

          <div class="text-gray-700 dark:text-white flex justify-evenly pt-3">
            <PencilSquareIcon class="h-7 w-7" />
            <EyeIcon class="h-7 w-7" />
            <TrashIcon
              class="h-7 w-7 text-red-700 hover:text-red-800 dark:text-red-600 dark:hover:text-red-700"
            />
          </div>
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
        Here at Flowbite we focus on markets where technology, innovation, and
        capital can unlock long-term value and drive economic growth.
      </p>
      <div class="w-full inline-flex justify-end items-center">
        <Button
          type="button"
          class="py-3 px-5 text-base font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800"
          @click="openModal"
        >
          Create an instance
        </Button>
      </div>
    </div>

    <SharedDialog :isOpen="isOpen" @closeDialog="closeModal">
      <template #title>Create a New Instance</template>

      <form class="mt-2" @submit.prevent="saveCollection">
        <div>
          <Label for="title" value="Title" />
          <Input
            id="title"
            type="text"
            class="mt-1 block w-full"
            v-model="form.title"
          />
          <InputError class="mt-2" :message="errors?.title" />
        </div>

        <div class="mt-4">
          <Label for="description" value="Description" />
          <Input
            id="description"
            type="text"
            class="mt-1 block w-full"
            v-model="form.description"
          />
          <InputError class="mt-2" :message="errors?.description" />
        </div>

        <div class="flex items-center justify-end mt-4">
          <Button
            class="inline-flex justify-center rounded-md border border-transparent bg-blue-100 px-4 py-2 text-sm font-medium text-blue-900 hover:bg-blue-200 focus:outline-none focus-visible:ring-2 focus-visible:ring-blue-500 focus-visible:ring-offset-2"
            :class="{ 'opacity-25': form.processing }"
            :disabled="form.processing"
          >
            Create
          </Button>
        </div>
      </form>
    </SharedDialog>
  </AuthenticatedLayout>
</template>
<style scoped>
.collection {
  max-width: 250px;
}
</style>
