<script setup>
import { useForm, usePage } from '@inertiajs/inertia-vue3';
import { computed } from '@vue/runtime-core';

const user = computed(() => usePage().props.value.auth.user);

const form = useForm({
  user_id: user.value.id,
  title: '',
  author: '',
  source: '',
  category: 'article',
  expires_at: new Date(Date.now())
});

const submit = () => {
  form.post(route('libraryStore'));
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
              <Button type="button">Create New</Button>
            </div>

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

            <div
              class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between mt-5"
            >
              <div>
                <p class="text-sm text-gray-700">
                  <span class="font-medium">
                    Showing {{ $page.props.data.meta.from }} to
                    {{ $page.props.data.meta.to }} of
                    {{ $page.props.data.meta.total }}
                    results
                  </span>
                </p>
              </div>

              <div>
                <nav
                  class="relative z-0 inline-flex rounded-md shadow-sm -space-x-px"
                  aria-label="Pagination"
                >
                  <a
                    href="#"
                    class="relative inline-flex items-center px-2 py-2 rounded-l-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50"
                  >
                    <span class="sr-only">Previous</span>
                    <!-- Heroicon name: solid/chevron-left -->
                    <svg
                      class="h-5 w-5"
                      xmlns="http://www.w3.org/2000/svg"
                      viewBox="0 0 20 20"
                      fill="currentColor"
                      aria-hidden="true"
                    >
                      <path
                        fill-rule="evenodd"
                        d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
                        clip-rule="evenodd"
                      />
                    </svg>
                  </a>
                  <!-- Current: "z-10 bg-indigo-50 border-indigo-500 text-indigo-600", Default: "bg-white border-gray-300 text-gray-500 hover:bg-gray-50" -->
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
                    <!-- Heroicon name: solid/chevron-right -->
                    <svg
                      class="h-5 w-5"
                      xmlns="http://www.w3.org/2000/svg"
                      viewBox="0 0 20 20"
                      fill="currentColor"
                      aria-hidden="true"
                    >
                      <path
                        fill-rule="evenodd"
                        d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                        clip-rule="evenodd"
                      />
                    </svg>
                  </a>
                </nav>
              </div>
            </div>

            <form @submit.prevent="submit">
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

              <div class="mt-4">
                <Label for="category" value="Category" />
                <Input
                  id="category"
                  type="text"
                  class="mt-1 block w-full"
                  v-model="form.category"
                />
                <InputError class="mt-2" :message="form.errors.category" />
              </div>

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
                  class="ml-4"
                  :class="{ 'opacity-25': form.processing }"
                  :disabled="form.processing"
                >
                  Register
                </Button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>
