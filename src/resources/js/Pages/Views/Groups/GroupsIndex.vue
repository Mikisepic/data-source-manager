<script setup>
import { ChevronDownIcon } from '@heroicons/vue/24/solid';
</script>
<template>
  <AuthenticatedLayout>
    <Head title="Groups" />

    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">Groups</h2>
    </template>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
          <div class="p-6 bg-white border-b border-gray-200">
            <table
              class="w-full table-auto border border-separate border-spacing-2"
            >
              <thead>
                <tr>
                  <th>Title</th>
                  <th>Data Sources Count</th>
                  <th>Created At</th>
                </tr>
              </thead>
              <tbody>
                <tr
                  v-for="group in $page.props.data.data"
                  v-bind:key="group.id"
                >
                  <td class="text-center">
                    <Link :href="route('groupsShow', group.id)">
                      {{ group.title }}
                    </Link>
                  </td>
                  <td class="text-center">
                    {{ group.data_sources_count }}
                  </td>
                  <td class="text-center">
                    {{ new Date(group.created_at).toDateString() }}
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
