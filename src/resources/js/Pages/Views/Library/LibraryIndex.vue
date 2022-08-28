<script setup>
import { ref } from 'vue';
import { useForm, usePage } from '@inertiajs/inertia-vue3';
import { computed, onMounted } from '@vue/runtime-core';
import {
  ChevronDownIcon,
  ChevronDoubleDownIcon,
  ChevronUpIcon
} from '@heroicons/vue/24/solid';
import { Popover, PopoverButton, PopoverPanel } from '@headlessui/vue';

import { useDataSources } from '@/Composables/DataSources';

const {
  dataSources,
  dataSourceMeta,
  dataSourceLinks,
  errors,
  getDataSources,
  storeDataSource
} = useDataSources();

onMounted(getDataSources);

const user = computed(() => usePage().props.value.auth.user);

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

const categories = [
  { name: 'Article', value: 'article' },
  { name: 'URL Link', value: 'link' },
  { name: 'Book', value: 'book' }
];

const isOpen = ref(false);
const selectedCategory = ref(categories[0]);

const form = useForm({
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
  form.reset();
};

const onSelectionChange = (param) => {
  selectedCategory.value = param;
  form.category = param.value;
};
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
                  <th scope="col" class="px-6 py-4 border-r">
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
                  <th scope="col" class="font-medium px-6 py-4 border-r">
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
                  <th scope="col" class="font-medium px-6 py-4">Expires At</th>
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
                    class="font-medium text-gray-900 whitespace-nowrap dark:text-white border-r"
                  >
                    <Link :href="dataSource.source">
                      {{ dataSource.title }}
                    </Link>
                  </td>
                  <td
                    class="text-sm font-light px-6 py-4 whitespace-nowrap border-r"
                  >
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
                  <td class="text-sm font-light px-6 py-4 whitespace-nowrap">
                    {{ new Date(dataSource.expires_at).toDateString() }}
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>

        <div class="flex flex-col mt-5">
          <div class="flex flex-col items-center mb-3">
            <span class="text-md text-gray-700 dark:text-gray-400">
              Showing
              <span class="font-semibold text-gray-900 dark:text-white">
                {{ dataSourceMeta.from }}
              </span>
              to
              <span class="font-semibold text-gray-900 dark:text-white">
                {{ dataSourceMeta.to }}
              </span>
              of
              <span class="font-semibold text-gray-900 dark:text-white">
                {{ dataSourceMeta.total }}
              </span>
              Entries
            </span>
          </div>

          <div class="mx-auto">
            <nav
              class="relative z-0 inline-flex rounded-md shadow-sm -space-x-px"
            >
              <Link
                :class="
                  dataSourceMeta.current_page === dataSourceMeta.from
                    ? 'pointer-events-none'
                    : ''
                "
                :href="
                  route('libraryIndex', {
                    page: dataSourceMeta.current_page - 1
                  })
                "
                class="relative inline-flex items-center px-2 py-2 text-gray-500 bg-white rounded-l-lg border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white"
              >
                <span class="sr-only">Previous</span>
                <ChevronDownIcon class="w-5 h-5 rotate-90" />
              </Link>
              <Link
                :href="route('libraryIndex', { page: 1 })"
                aria-current="page"
                :class="
                  dataSourceMeta.current_page === dataSourceMeta.from
                    ? 'z-10 py-2 px-3 leading-tight text-blue-600 bg-blue-50 border border-blue-300 hover:bg-blue-100 hover:text-blue-700 dark:border-gray-700 dark:bg-gray-700 dark:text-white'
                    : 'py-2 px-3 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white'
                "
              >
                1
              </Link>
              <span
                class="relative inline-flex items-center py-2 px-3 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white"
              >
                ...
              </span>
              <Link
                :href="
                  route('libraryIndex', {
                    page: dataSourceMeta.last_page
                  })
                "
                aria-current="page"
                :class="
                  dataSourceMeta.current_page === dataSourceMeta.last_page
                    ? 'z-10 py-2 px-3 leading-tight text-blue-600 bg-blue-50 border border-blue-300 hover:bg-blue-100 hover:text-blue-700 dark:border-gray-700 dark:bg-gray-700 dark:text-white'
                    : 'py-2 px-3 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white'
                "
              >
                {{ dataSourceMeta.last_page }}
              </Link>

              <Link
                :class="
                  dataSourceMeta.current_page === dataSourceMeta.last_page
                    ? 'pointer-events-none'
                    : ''
                "
                :href="
                  route('libraryIndex', {
                    page: dataSourceMeta.current_page + 1
                  })
                "
                class="relative inline-flex py-2 px-3 leading-tight text-gray-500 bg-white rounded-r-lg border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white"
              >
                <span class="sr-only">Next</span>
                <ChevronDownIcon class="w-5 h-5 -rotate-90" />
              </Link>
            </nav>
          </div>
        </div>
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
  </AuthenticatedLayout>
</template>
<style scoped>
th,
td {
  max-width: 200px;
}
</style>
