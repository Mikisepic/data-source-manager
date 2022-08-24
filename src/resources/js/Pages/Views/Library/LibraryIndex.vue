<script setup>
import { ref } from 'vue';
import { useForm, usePage } from '@inertiajs/inertia-vue3';
import { computed } from '@vue/runtime-core';
import { ChevronDownIcon } from '@heroicons/vue/24/solid';

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

            <table
              class="w-full table-auto border border-separate border-spacing-2"
            >
              <thead>
                <tr>
                  <th>Title</th>
                  <th>Author</th>
                  <th>Category</th>
                  <th>Created At</th>
                  <th>Expiration Date</th>
                </tr>
              </thead>
              <tbody>
                <tr
                  v-for="dataSource in $page.props.data.data"
                  v-bind:key="dataSource.id"
                >
                  <td class="text-center">
                    <Link :href="dataSource.source">
                      {{ dataSource.title }}
                    </Link>
                  </td>
                  <td class="text-center">
                    <Link :href="route('libraryShow', dataSource.id)">
                      {{ dataSource.author }}
                    </Link>
                  </td>
                  <td class="text-center">
                    {{ $titlecase(dataSource.category) }}
                  </td>
                  <td class="text-center">
                    {{ new Date(dataSource.created_at).toDateString() }}
                  </td>
                  <td class="text-center">
                    {{ new Date(dataSource.expires_at).toDateString() }}
                  </td>
                </tr>
              </tbody>
            </table>

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
                  <a
                    href="#"
                    class="relative inline-flex items-center px-2 py-2 rounded-l-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50"
                  >
                    <span class="sr-only">Previous</span>
                    <ChevronDownIcon class="w-5 h-5 rotate-90" />
                  </a>
                  <a
                    href="#"
                    aria-current="page"
                    class="z-10 bg-indigo-50 border-indigo-500 text-indigo-600 relative inline-flex items-center px-4 py-2 border text-sm font-medium"
                  >
                    1
                  </a>
                  <span
                    class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-700"
                  >
                    ...
                  </span>
                  <a
                    href="#"
                    aria-current="page"
                    class="bg-white border-gray-300 text-gray-500 hover:bg-gray-50 relative inline-flex items-center px-4 py-2 border text-sm font-medium"
                  >
                    {{ $page.props.data.meta.last_page }}
                  </a>

                  <a
                    href="#"
                    class="relative inline-flex items-center px-2 py-2 rounded-r-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50"
                  >
                    <span class="sr-only">Next</span>
                    <ChevronDownIcon class="w-5 h-5 -rotate-90" />
                  </a>
                </nav>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>
