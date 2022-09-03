<script setup>
import { ChevronDownIcon } from '@heroicons/vue/24/solid';

defineProps({
  meta: {
    from: Number,
    to: Number,
    total: Number,
    current_page: Number,
    last_page: Number
  },
  routeName: String
});
</script>
<template>
  <div class="flex items-center justify-center flex-col">
    <div class="flex flex-col mt-5">
      <div class="flex flex-col items-center mb-3">
        <span class="text-md text-gray-700 dark:text-gray-400">
          Showing
          <span class="font-semibold text-gray-900 dark:text-white">
            {{ meta.from }}
          </span>
          to
          <span class="font-semibold text-gray-900 dark:text-white">
            {{ meta.to }}
          </span>
          of
          <span class="font-semibold text-gray-900 dark:text-white">
            {{ meta.total }}
          </span>
          Entries
        </span>
      </div>
    </div>

    <nav
      v-if="meta.total > 3"
      class="relative z-0 inline-flex rounded-md shadow-sm -space-x-px"
    >
      <Link
        :class="meta.current_page === meta.from ? 'pointer-events-none' : ''"
        :href="
          route(routeName, {
            page: meta.current_page - 1
          })
        "
        class="relative inline-flex items-center px-2 py-2 text-gray-500 bg-white rounded-l-lg border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white"
      >
        <span class="sr-only">Previous</span>
        <ChevronDownIcon class="w-5 h-5 rotate-90" />
      </Link>
      <Link
        :href="route(routeName, { page: 1 })"
        aria-current="page"
        :class="
          meta.current_page === meta.from
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
          route(routeName, {
            page: meta.last_page
          })
        "
        aria-current="page"
        :class="
          meta.current_page === meta.last_page
            ? 'z-10 py-2 px-3 leading-tight text-blue-600 bg-blue-50 border border-blue-300 hover:bg-blue-100 hover:text-blue-700 dark:border-gray-700 dark:bg-gray-700 dark:text-white'
            : 'py-2 px-3 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white'
        "
      >
        {{ meta.last_page }}
      </Link>

      <Link
        :class="
          meta.current_page === meta.last_page ? 'pointer-events-none' : ''
        "
        :href="
          route(routeName, {
            page: meta.current_page + 1
          })
        "
        class="relative inline-flex py-2 px-3 leading-tight text-gray-500 bg-white rounded-r-lg border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white"
      >
        <span class="sr-only">Next</span>
        <ChevronDownIcon class="w-5 h-5 -rotate-90" />
      </Link>
    </nav>

    <nav
      v-else
      class="relative z-0 inline-flex rounded-md shadow-sm -space-x-px"
    >
      <Link
        :class="meta.current_page === meta.from ? 'pointer-events-none' : ''"
        :href="
          route(routeName, {
            page: meta.current_page - 1
          })
        "
        class="relative inline-flex items-center px-2 py-2 text-gray-500 bg-white rounded-l-lg border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white"
      >
        <span class="sr-only">Previous</span>
        <ChevronDownIcon class="w-5 h-5 rotate-90" />
      </Link>

      <Link
        v-for="(page, index) in meta.last_page"
        v-bind:key="index"
        :href="route(routeName, { page })"
        aria-current="page"
        :class="
          meta.current_page === page
            ? 'z-10 py-2 px-3 leading-tight text-blue-600 bg-blue-50 border border-blue-300 hover:bg-blue-100 hover:text-blue-700 dark:border-gray-700 dark:bg-gray-700 dark:text-white'
            : 'py-2 px-3 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white'
        "
      >
        {{ page }}
      </Link>

      <Link
        :class="
          meta.current_page === meta.last_page ? 'pointer-events-none' : ''
        "
        :href="
          route(routeName, {
            page: meta.current_page + 1
          })
        "
        class="relative inline-flex py-2 px-3 leading-tight text-gray-500 bg-white rounded-r-lg border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white"
      >
        <span class="sr-only">Next</span>
        <ChevronDownIcon class="w-5 h-5 -rotate-90" />
      </Link>
    </nav>
  </div>
</template>
