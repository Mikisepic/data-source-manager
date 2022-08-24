<script setup>
import { ref } from 'vue';
import { useForm, usePage } from '@inertiajs/inertia-vue3';
import { computed } from '@vue/runtime-core';
import {
  ChevronDownIcon,
  ChevronDoubleDownIcon,
  ChevronUpIcon
} from '@heroicons/vue/24/solid';
import { Popover, PopoverButton, PopoverPanel } from '@headlessui/vue';

const user = computed(() => usePage().props.value.auth.user);

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

const submit = () => {
  form.post(route('libraryStore'));
  closeModal();
};

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
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">Library</h2>
    </template>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
          <div class="p-6 bg-white border-b border-gray-200">
            <div class="flex items-center justify-end mb-4">
              <Button type="button" @click="openModal">Create New</Button>
            </div>

            <div class="flex flex-col">
              <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="py-2 inline-block min-w-full sm:px-6 lg:px-8">
                  <div class="overflow-hidden">
                    <table class="min-w-full table-fixed border text-center">
                      <thead class="border-b">
                        <tr>
                          <th
                            scope="col"
                            class="font-medium text-gray-900 px-6 py-4 border-r"
                          >
                            <Popover v-slot="{ open }" class="relative">
                              <PopoverButton
                                :class="open ? '' : 'text-opacity-90'"
                                class="group w-full inline-flex items-center justify-between rounded-md px-3 py-2 font-medium hover:text-opacity-100 focus:outline-none focus-visible:ring-2 focus-visible:ring-white focus-visible:ring-opacity-75"
                              >
                                <span>Title</span>
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
                          <th
                            scope="col"
                            class="font-medium text-gray-900 px-6 py-4 border-r w-20"
                          >
                            <Popover v-slot="{ open }" class="relative">
                              <PopoverButton
                                :class="open ? '' : 'text-opacity-90'"
                                class="group w-full inline-flex items-center justify-between rounded-md px-3 py-2 font-medium hover:text-opacity-100 focus:outline-none focus-visible:ring-2 focus-visible:ring-white focus-visible:ring-opacity-75"
                              >
                                <span>Author</span>
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
                          <th
                            scope="col"
                            class="font-medium text-gray-900 px-6 py-4 border-r"
                          >
                            <Popover v-slot="{ open }" class="relative">
                              <PopoverButton
                                :class="open ? '' : 'text-opacity-90'"
                                class="group w-full inline-flex items-center justify-between rounded-md px-3 py-2 font-medium hover:text-opacity-100 focus:outline-none focus-visible:ring-2 focus-visible:ring-white focus-visible:ring-opacity-75"
                              >
                                <span>Category</span>
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
                          <th
                            scope="col"
                            class="font-medium text-gray-900 px-6 py-4 border-r"
                          >
                            <div class="flex align-center justify-between">
                              <span>Created At</span>
                              <ChevronDoubleDownIcon
                                class="ml-2 h-5 w-5 transition duration-150 ease-in-out group-hover:text-opacity-80"
                                aria-hidden="true"
                              />
                            </div>
                          </th>
                          <th
                            scope="col"
                            class="font-medium text-gray-900 px-6 py-4"
                          >
                            <div class="flex align-center justify-between">
                              <span>Expires At</span>
                              <ChevronDoubleDownIcon
                                class="ml-2 h-5 w-5 transition duration-150 ease-in-out group-hover:text-opacity-80"
                                aria-hidden="true"
                              />
                            </div>
                          </th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr
                          class="border-b"
                          v-for="dataSource in $page.props.data.data"
                          v-bind:key="dataSource.id"
                        >
                          <td
                            class="text-sm text-left text-gray-900 font-light px-6 py-4 border-r"
                          >
                            <Link :href="dataSource.source">
                              {{ dataSource.title }}
                            </Link>
                          </td>
                          <td
                            class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap border-r"
                          >
                            <Link :href="route('libraryShow', dataSource.id)">
                              {{ dataSource.author }}
                            </Link>
                          </td>
                          <td
                            class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap border-r"
                          >
                            {{ $titlecase(dataSource.category) }}
                          </td>
                          <td
                            class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap border-r"
                          >
                            {{ new Date(dataSource.created_at).toDateString() }}
                          </td>
                          <td
                            class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap"
                          >
                            {{ new Date(dataSource.expires_at).toDateString() }}
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>

                <div class="flex flex-col mt-5">
                  <div class="mx-auto mb-3">
                    <p class="text-sm text-gray-700">
                      <span class="font-medium">
                        Showing {{ $page.props.data.meta.from }} to
                        {{ $page.props.data.meta.to }} of
                        {{ $page.props.data.meta.total }}
                        results
                      </span>
                    </p>
                  </div>

                  <div class="mx-auto">
                    <nav
                      class="relative z-0 inline-flex rounded-md shadow-sm -space-x-px"
                      aria-label="Pagination"
                    >
                      <Link
                        :href="$page.props.data.links.prev"
                        class="relative inline-flex items-center px-2 py-2 rounded-l-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50"
                      >
                        <span class="sr-only">Previous</span>
                        <ChevronDownIcon class="w-5 h-5 rotate-90" />
                      </Link>
                      <Link
                        :href="$page.props.data.links.first"
                        aria-current="page"
                        :class="
                          $page.props.data.meta.current_page === 1
                            ? 'z-10 bg-indigo-50 border-indigo-500 text-indigo-600 relative inline-flex items-center px-4 py-2 border text-sm font-medium'
                            : 'bg-white border-gray-300 text-gray-500 hover:bg-gray-50 relative inline-flex items-center px-4 py-2 border text-sm font-medium'
                        "
                      >
                        1
                      </Link>
                      <span
                        class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-700"
                      >
                        ...
                      </span>
                      <Link
                        :href="$page.props.data.links.last"
                        aria-current="page"
                        :class="
                          $page.props.data.meta.current_page ===
                          $page.props.data.meta.last_page
                            ? 'z-10 bg-indigo-50 border-indigo-500 text-indigo-600 relative inline-flex items-center px-4 py-2 border text-sm font-medium'
                            : 'bg-white border-gray-300 text-gray-500 hover:bg-gray-50 relative inline-flex items-center px-4 py-2 border text-sm font-medium'
                        "
                      >
                        {{ $page.props.data.meta.last_page }}
                      </Link>

                      <Link
                        :href="$page.props.data.links.next"
                        class="relative inline-flex items-center px-2 py-2 rounded-r-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50"
                      >
                        <span class="sr-only">Next</span>
                        <ChevronDownIcon class="w-5 h-5 -rotate-90" />
                      </Link>
                    </nav>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <SharedDialog :isOpen="isOpen" @closeDialog="closeModal">
      <template #title>Create new instance</template>

      <form class="mt-2" @submit.prevent="submit">
        <div>
          <Label for="title" value="Title" />
          <Input
            id="title"
            type="text"
            class="mt-1 block w-full"
            v-model="form.title"
          />
          <InputError class="mt-2" :message="form.errors.title" />
        </div>

        <div class="mt-4">
          <Label for="author" value="Author" />
          <Input
            id="author"
            type="text"
            class="mt-1 block w-full"
            v-model="form.author"
          />
          <InputError class="mt-2" :message="form.errors.author" />
        </div>

        <div class="mt-4">
          <Label for="source" value="Source" />
          <Input
            id="source"
            type="url"
            class="mt-1 block w-full"
            v-model="form.source"
          />
          <InputError class="mt-2" :message="form.errors.source" />
        </div>

        <Select
          :selectedOption="selectedCategory"
          :options="categories"
          @selectionChange="(e) => onSelectionChange(e)"
        ></Select>

        <div class="mt-4">
          <Label for="expires_at" value="Expires At" />
          <Input
            id="expires_at"
            type="date"
            class="mt-1 block w-full"
            v-model="form.expires_at"
          />
          <InputError class="mt-2" :message="form.errors.expires_at" />
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
