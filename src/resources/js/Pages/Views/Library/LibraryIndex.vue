<script setup>
import { ref } from 'vue';
import { useForm, usePage } from '@inertiajs/inertia-vue3';
import { computed, onMounted, reactive } from '@vue/runtime-core';
import {
  ChevronDownIcon,
  ChevronDoubleDownIcon,
  ChevronUpIcon,
  EllipsisVerticalIcon,
  TrashIcon,
  PencilSquareIcon,
  PlusIcon
} from '@heroicons/vue/24/solid';
import { Popover, PopoverButton, PopoverPanel } from '@headlessui/vue';

import { useDataSources } from '@/Composables/DataSources';

const {
  dataSource,
  dataSources,
  dataSourceMeta,
  dataSourceLinks,
  errors,
  getDataSources,
  getDataSource,
  storeDataSource,
  destroyDataSource
} = useDataSources();

const saveDataSource = async () => {
  await storeDataSource({ ...form });
  getDataSources();

  if (!!!errors.value) {
    closeModal();
  }
};

const deleteDataSource = async (id) => {
  await destroyDataSource(id);
  await getDataSources();
};

const user = computed(() => usePage().props.value.auth.user);

const openPreviewDialog = computed(
  () => usePage().props.value.openPreviewDialog
);

const closePreviewDialog = () => {
  console.log(route());
};

const resetFormValues = () => {
  form.user_id = user.value.id;
  form.title = '';
  form.author = '';
  form.source = '';
  form.category = selectedCategory.value.value;
  form.expires_at = new Date(Date.now());
};

const categories = [
  { name: 'Article', value: 'article' },
  { name: 'URL Link', value: 'link' },
  { name: 'Book', value: 'book' }
];

const isOpen = ref(false);
const selectedCategory = ref(categories[0]);

const form = reactive({
  user_id: user.value.id,
  title: '',
  author: '',
  source: '',
  category: selectedCategory.value.value,
  expires_at: new Date(Date.now())
});

const openModal = () => (isOpen.value = true);
const closeModal = () => {
  isOpen.value = false;
  resetFormValues();
};

const onSelectionChange = (param) => {
  selectedCategory.value = param;
  form.category = param.value;
};

onMounted(() => {
  getDataSources();
  if (openPreviewDialog.value) {
    const url = new URL(window.location);
    getDataSource(url.pathname.split('/')[2]);
  }
});
</script>
<template>
  <AuthenticatedLayout>
    <Head title="Library" />

    <template #header>
      <h2
        class="font-semibold text-xl text-gray-800 dark:text-white leading-tight"
      >
        Library
      </h2>
    </template>

    <div class="flex items-center justify-end mb-4">
      <Button type="button" @click="openModal">Create New</Button>
    </div>

    <div class="flex flex-col">
      <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
        <div class="py-2 inline-block min-w-full sm:px-6 lg:px-8">
          <div class="overflow-hidden">
            <table
              class="min-w-full table-fixed text-center text-gray-500 dark:text-gray-400"
            >
              <thead
                class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400"
              >
                <tr>
                  <th scope="col" class="px-6 py-4 border-r w-15">
                    <Popover v-slot="{ open }" class="relative">
                      <PopoverButton
                        :class="open ? '' : 'text-opacity-90'"
                        class="group w-full inline-flex items-center justify-between rounded-md px-3 py-2 font-medium hover:text-opacity-100 focus:outline-none focus-visible:ring-2 focus-visible:ring-white focus-visible:ring-opacity-75"
                      >
                        <span class="uppercase">Title</span>
                        <ChevronDoubleDownIcon
                          :class="open ? 'rotate-180 transform' : ''"
                          class="ml-2 h-5 w-5 transition duration-150 ease-in-out group-hover:text-opacity-80"
                          aria-hidden="true"
                        />
                      </PopoverButton>

                      <transition
                        enter-active-class="transition duration-200 ease-out"
                        enter-from-class="translate-y-1 opacity-0"
                        enter-to-class="translate-y-0 opacity-100"
                        leave-active-class="transition duration-150 ease-in"
                        leave-from-class="translate-y-0 opacity-100"
                        leave-to-class="translate-y-1 opacity-0"
                      >
                        <PopoverPanel
                          class="absolute z-10 w-full max-w-sm transform px-4 sm:px-0"
                        >
                          <div
                            class="overflow-hidden rounded-lg ring-1 ring-black ring-opacity-5"
                          >
                            <div class="border bg-white p-4">
                              <div class="mb-6 w-full">
                                <label
                                  for="nameContains"
                                  class="block mb-2 text-md text-left font-light text-gray-900 dark:text-gray-300"
                                >
                                  Title Contains
                                </label>
                                <input
                                  type="text"
                                  id="nameContains"
                                  class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white"
                                />
                              </div>
                            </div>
                          </div>
                        </PopoverPanel>
                      </transition>
                    </Popover>
                  </th>
                  <th scope="col" class="font-medium px-6 py-4 border-r w-20">
                    <Popover v-slot="{ open }" class="relative">
                      <PopoverButton
                        :class="open ? '' : 'text-opacity-90'"
                        class="group w-full inline-flex items-center justify-between rounded-md px-3 py-2 font-medium hover:text-opacity-100 focus:outline-none focus-visible:ring-2 focus-visible:ring-white focus-visible:ring-opacity-75"
                      >
                        <span class="uppercase">Author</span>
                        <ChevronDoubleDownIcon
                          :class="open ? 'rotate-180 transform' : ''"
                          class="ml-2 h-5 w-5 transition duration-150 ease-in-out group-hover:text-opacity-80"
                          aria-hidden="true"
                        />
                      </PopoverButton>

                      <transition
                        enter-active-class="transition duration-200 ease-out"
                        enter-from-class="translate-y-1 opacity-0"
                        enter-to-class="translate-y-0 opacity-100"
                        leave-active-class="transition duration-150 ease-in"
                        leave-from-class="translate-y-0 opacity-100"
                        leave-to-class="translate-y-1 opacity-0"
                      >
                        <PopoverPanel
                          class="absolute z-10 w-full max-w-sm transform px-4 sm:px-0"
                        >
                          <div
                            class="overflow-hidden rounded-lg ring-1 ring-black ring-opacity-5"
                          >
                            <div class="border bg-white p-4">
                              <div class="mb-6 w-full">
                                <label
                                  for="nameContains"
                                  class="block mb-2 text-md text-left font-light text-gray-900 dark:text-gray-300"
                                >
                                  Author Name Contains
                                </label>
                                <input
                                  type="text"
                                  id="nameContains"
                                  class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white"
                                />
                              </div>
                            </div>
                          </div>
                        </PopoverPanel>
                      </transition>
                    </Popover>
                  </th>
                  <th scope="col" class="font-medium px-6 py-4 border-r w-10">
                    <Popover v-slot="{ open }" class="relative">
                      <PopoverButton
                        :class="open ? '' : 'text-opacity-90'"
                        class="group w-full inline-flex items-center justify-between rounded-md px-3 py-2 font-medium hover:text-opacity-100 focus:outline-none focus-visible:ring-2 focus-visible:ring-white focus-visible:ring-opacity-75"
                      >
                        <span class="uppercase">Category</span>
                        <ChevronDoubleDownIcon
                          :class="open ? 'rotate-180 transform' : ''"
                          class="ml-2 h-5 w-5 transition duration-150 ease-in-out group-hover:text-opacity-80"
                          aria-hidden="true"
                        />
                      </PopoverButton>

                      <transition
                        enter-active-class="transition duration-200 ease-out"
                        enter-from-class="translate-y-1 opacity-0"
                        enter-to-class="translate-y-0 opacity-100"
                        leave-active-class="transition duration-150 ease-in"
                        leave-from-class="translate-y-0 opacity-100"
                        leave-to-class="translate-y-1 opacity-0"
                      >
                        <PopoverPanel
                          class="absolute z-10 w-full max-w-sm transform px-4 sm:px-0"
                        >
                          <div
                            class="overflow-hidden rounded-lg ring-1 ring-black ring-opacity-5"
                          >
                            <div class="border bg-white p-4">
                              <div class="mb-6 w-full">
                                <label
                                  for="nameContains"
                                  class="block mb-2 text-md text-left font-light text-gray-900 dark:text-gray-300"
                                >
                                  Category
                                </label>
                                <input
                                  type="text"
                                  id="nameContains"
                                  class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white"
                                />
                              </div>
                            </div>
                          </div>
                        </PopoverPanel>
                      </transition>
                    </Popover>
                  </th>
                  <th scope="col" class="font-medium px-6 py-4 border-r">
                    Created At
                  </th>
                  <th scope="col" class="font-medium px-6 py-4 border-r">
                    Expires At
                  </th>
                  <th scope="col" class="font-medium px-6 py-4 w-10">
                    Actions
                  </th>
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
                  v-for="(dataSource, index) in dataSources"
                  v-bind:key="dataSource.id"
                >
                  <td
                    class="font-medium text-left text-gray-900 px-6 py-4 text-ellipsis overflow-hidden whitespace-nowrap dark:text-white border-r"
                  >
                    <Link :href="dataSource.source">
                      {{ dataSource.title }}
                    </Link>
                  </td>
                  <td class="text-sm font-light px-6 py-4 break-all border-r">
                    {{ dataSource.author }}
                  </td>
                  <td
                    class="text-sm font-light px-6 py-4 whitespace-nowrap border-r"
                  >
                    {{ $titlecase(dataSource.category) }}
                  </td>
                  <td
                    class="text-sm font-light px-6 py-4 whitespace-nowrap border-r"
                  >
                    {{ new Date(dataSource.created_at).toDateString() }}
                  </td>
                  <td
                    class="text-sm font-light px-6 py-4 whitespace-nowrap border-r"
                  >
                    {{ new Date(dataSource.expires_at).toDateString() }}
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap">
                    <Dropdown align="right" width="48">
                      <template #trigger>
                        <span class="inline-flex rounded-md">
                          <button
                            type="button"
                            class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-white bg-transparent dark:bg-gray-700 hover:text-gray-700 focus:outline-none transition ease-in-out duration-150"
                          >
                            <EllipsisVerticalIcon class="h-7 w-7" />
                          </button>
                        </span>
                      </template>

                      <template #content>
                        <DropdownLink
                          :href="route('libraryShow', dataSource.id)"
                          as="button"
                          class="flex items-center gap-2 text-md"
                        >
                          <PencilSquareIcon class="h-5 w-5" />
                          <span>Edit</span>
                        </DropdownLink>
                        <DropdownLink
                          :href="route('libraryShow', dataSource.id)"
                          as="button"
                          class="flex items-center gap-2 text-md"
                        >
                          <PlusIcon class="h-5 w-5" />
                          <span>Assign to</span>
                        </DropdownLink>
                        <DropdownLink
                          @click="deleteDataSource(dataSource.id)"
                          as="button"
                          class="flex items-center gap-2 text-md text-red-700 hover:text-red-800 dark:text-red-600 dark:hover:text-red-700"
                        >
                          <TrashIcon class="h-5 w-5" />
                          <span>Delete</span>
                        </DropdownLink>
                      </template>
                    </Dropdown>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
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
    </div>

    <SharedDialog :isOpen="isOpen" @closeDialog="closeModal">
      <template #title>Create new instance</template>

      <form class="mt-2" @submit.prevent="saveDataSource">
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
          <Label for="author" value="Author" />
          <Input
            id="author"
            type="text"
            class="mt-1 block w-full"
            v-model="form.author"
          />
          <InputError class="mt-2" :message="errors?.author" />
        </div>

        <div class="mt-4">
          <Label for="source" value="Source" />
          <Input
            id="source"
            type="url"
            class="mt-1 block w-full"
            v-model="form.source"
          />
          <InputError class="mt-2" :message="errors?.source" />
        </div>

        <div class="mt-4">
          <Select
            :selectedOption="selectedCategory"
            :options="categories"
            @selectionChange="(e) => onSelectionChange(e)"
          ></Select>
        </div>

        <div class="mt-4">
          <Label for="expires_at" value="Expires At" />
          <Input
            id="expires_at"
            type="date"
            class="mt-1 block w-full"
            v-model="form.expires_at"
          />
          <InputError class="mt-2" :message="errors?.expires_at" />
        </div>

        <div class="flex items-center justify-end mt-4">
          <Button
            class="inline-flex justify-center rounded-md border border-transparent bg-blue-100 px-4 py-2 text-sm font-medium text-blue-900 hover:bg-blue-200 focus:outline-none focus-visible:ring-2 focus-visible:ring-blue-500 focus-visible:ring-offset-2"
            :class="{ 'opacity-25': form.processing }"
            :disabled="form.processing"
          >
            Register
          </Button>
        </div>
      </form>
    </SharedDialog>

    <SharedDialog :isOpen="openPreviewDialog" @closeDialog="closePreviewDialog">
      <template #title>Preview Instance</template>

      <Button
        class="inline-flex justify-center rounded-md border border-transparent bg-blue-100 px-4 py-2 text-sm font-medium text-blue-900 hover:bg-blue-200 focus:outline-none focus-visible:ring-2 focus-visible:ring-blue-500 focus-visible:ring-offset-2"
      >
        Register
      </Button>
      <Link :href="route('libraryIndex')" @click="closePreviewDialog">
        <Button
          class="inline-flex justify-center rounded-md border border-transparent bg-blue-100 px-4 py-2 text-sm font-medium text-blue-900 hover:bg-blue-200 focus:outline-none focus-visible:ring-2 focus-visible:ring-blue-500 focus-visible:ring-offset-2"
        >
          Cancel
        </Button>
      </Link>
    </SharedDialog>
  </AuthenticatedLayout>
</template>
<style scoped>
th,
td {
  max-width: 200px;
}
</style>
