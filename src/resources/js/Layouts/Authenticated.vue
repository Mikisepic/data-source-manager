<script setup>
import { ref } from 'vue';
import {
  ChevronDownIcon,
  Bars3BottomRightIcon,
  XMarkIcon
} from '@heroicons/vue/24/solid';

const showingNavigationDropdown = ref(false);

const items = [
  {
    title: 'Library',
    pathName: 'libraryIndex'
  },
  {
    title: 'Collections',
    pathName: 'collectionIndex'
  },
  {
    title: 'Groups',
    pathName: 'groupIndex'
  },
  {
    title: 'Profile',
    pathName: 'profileShow'
  },
  {
    title: 'Settings',
    pathName: 'settings'
  }
];
</script>
<template>
  <div class="min-h-screen bg-gray-100 dark:bg-gray-800">
    <nav class="bg-white sticky top-0 z-10 dark:bg-gray-800">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
          <div class="flex">
            <div class="shrink-0 flex items-center">
              <Link :href="route('dashboard')">
                <ApplicationLogo class="block h-9 w-auto" />
              </Link>
            </div>

            <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
              <NavLink
                v-for="(item, index) in items"
                v-bind:key="index"
                :href="route(item.pathName)"
                :active="route().current(item.pathName)"
              >
                {{ item.title }}
              </NavLink>
            </div>
          </div>

          <div class="hidden sm:flex sm:items-center sm:ml-6">
            <div class="ml-3 relative">
              <Dropdown align="right" width="48">
                <template #trigger>
                  <span class="inline-flex rounded-md">
                    <button
                      type="button"
                      class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-white bg-white dark:bg-gray-700 hover:text-gray-700 focus:outline-none transition ease-in-out duration-150"
                    >
                      <span>
                        {{ $page.props.auth.user.first_name }}
                        {{ $page.props.auth.user.last_name }}
                      </span>

                      <ChevronDownIcon class="ml-5 h-5 w-5" />
                    </button>
                  </span>
                </template>

                <template #content>
                  <DropdownLink
                    :href="route('logout')"
                    method="post"
                    as="button"
                  >
                    Log Out
                  </DropdownLink>
                </template>
              </Dropdown>
            </div>
          </div>

          <div class="-mr-2 flex items-center sm:hidden">
            <button
              @click="showingNavigationDropdown = !showingNavigationDropdown"
              class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out"
            >
              <Bars3BottomRightIcon
                v-if="!showingNavigationDropdown"
                class="h-6 w-6"
              />
              <XMarkIcon v-else class="h-6 w-6" />
            </button>
          </div>
        </div>
      </div>

      <div
        :class="{
          block: showingNavigationDropdown,
          hidden: !showingNavigationDropdown
        }"
        class="sm:hidden"
      >
        <div class="pt-2 pb-3 space-y-1">
          <ResponsiveNavLink
            v-for="(item, index) in items"
            v-bind:key="index"
            :href="route(item.pathName)"
            :active="route().current(item.pathName)"
          >
            {{ item.title }}
          </ResponsiveNavLink>
        </div>

        <div class="pt-4 pb-1 border-t border-gray-200">
          <div class="px-4">
            <div class="font-medium text-base text-gray-800">
              {{ $page.props.auth.user.username }}
            </div>
            <div class="font-medium text-sm text-gray-500">
              {{ $page.props.auth.user.email }}
            </div>
          </div>

          <div class="mt-3 space-y-1">
            <ResponsiveNavLink
              :href="route('logout')"
              method="post"
              as="button"
            >
              Log Out
            </ResponsiveNavLink>
          </div>
        </div>
      </div>
    </nav>

    <header class="bg-white dark:bg-gray-800 mb-4" v-if="$slots.header">
      <div class="max-w-7xl mx-auto py-4 px-12 sm:px-6 lg:px-12">
        <slot name="header" />
      </div>
    </header>

    <main class="max-w-7xl min-h-[72vh] mb-4 mx-auto px-4 sm:px-6 lg:px-8">
      <div
        class="overflow-hidden bg-white dark:bg-gray-700 rounded-lg py-4 px-4 dark:bg-gray-800"
      >
        <slot />
      </div>
    </main>

    <footer
      class="p-4 bg-white rounded-lg md:flex md:items-center md:justify-between md:p-6 dark:bg-gray-800"
    >
      <span class="text-sm text-gray-500 sm:text-center dark:text-gray-400">
        © {{ new Date().getFullYear() }}
        <a href="#" class="hover:underline">MAGicle™</a>. All Rights Reserved.
      </span>
      <ul
        class="flex flex-wrap items-center mt-3 text-sm text-gray-500 dark:text-gray-400 sm:mt-0"
      >
        <li>
          <a href="#" class="mr-4 hover:underline md:mr-6">About</a>
        </li>
        <li>
          <a href="#" class="mr-4 hover:underline md:mr-6">Contributing</a>
        </li>
        <li>
          <a href="#" class="hover:underline">Contact</a>
        </li>
      </ul>
    </footer>
  </div>
</template>
