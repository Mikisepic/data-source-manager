<script setup>
import { ChevronDownIcon } from '@heroicons/vue/24/solid';
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
      <Button type="button">Create New</Button>
    </div>

    <div
      class="p-6 max-w-sm bg-white rounded-lg border border-gray-200 shadow-md dark:bg-gray-800 dark:border-gray-700"
    >
      <svg
        class="mb-2 w-10 h-10 text-gray-500 dark:text-gray-400"
        aria-hidden="true"
        fill="currentColor"
        viewBox="0 0 20 20"
        xmlns="http://www.w3.org/2000/svg"
      >
        <path
          fill-rule="evenodd"
          d="M5 5a3 3 0 015-2.236A3 3 0 0114.83 6H16a2 2 0 110 4h-5V9a1 1 0 10-2 0v1H4a2 2 0 110-4h1.17C5.06 5.687 5 5.35 5 5zm4 1V5a1 1 0 10-1 1h1zm3 0a1 1 0 10-1-1v1h1z"
          clip-rule="evenodd"
        ></path>
        <path
          d="M9 11H3v5a2 2 0 002 2h4v-7zM11 18h4a2 2 0 002-2v-5h-6v7z"
        ></path>
      </svg>
      <a href="#">
        <h5
          class="mb-2 text-2xl font-semibold tracking-tight text-gray-900 dark:text-white"
        >
          Need a help in Claim?
        </h5>
      </a>
      <p class="mb-3 font-normal text-gray-500 dark:text-gray-400">
        Go to this step by step guideline process on how to certify for your
        weekly benefits:
      </p>
      <a
        href="#"
        class="inline-flex items-center text-blue-600 hover:underline"
      >
        See our guideline
        <svg
          class="ml-2 w-5 h-5"
          fill="currentColor"
          viewBox="0 0 20 20"
          xmlns="http://www.w3.org/2000/svg"
        >
          <path
            d="M11 3a1 1 0 100 2h2.586l-6.293 6.293a1 1 0 101.414 1.414L15 6.414V9a1 1 0 102 0V4a1 1 0 00-1-1h-5z"
          ></path>
          <path
            d="M5 5a2 2 0 00-2 2v8a2 2 0 002 2h8a2 2 0 002-2v-3a1 1 0 10-2 0v3H5V7h3a1 1 0 000-2H5z"
          ></path>
        </svg>
      </a>
    </div>

    <table class="w-full table-auto border border-separate border-spacing-2">
      <thead>
        <tr>
          <th>Title</th>
          <th>Data Sources</th>
          <th>Created At</th>
        </tr>
      </thead>
      <tbody>
        <tr
          v-for="collection in $page.props.data.data"
          v-bind:key="collection.id"
        >
          <td class="text-center">
            <Link :href="route('collectionsShow', collection.id)">
              {{ collection.title }}
            </Link>
          </td>
          <td class="text-center">
            {{ collection.data_sources_count }}
          </td>
          <td class="text-center">
            {{ new Date(collection.created_at).toDateString() }}
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
  </AuthenticatedLayout>
</template>
