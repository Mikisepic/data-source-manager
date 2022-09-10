<script setup>
import {
  ChevronDownIcon,
  Bars3BottomRightIcon,
  XMarkIcon,
  BellIcon,
  BellAlertIcon
} from '@heroicons/vue/24/outline';
import { onMounted, ref } from '@vue/runtime-core';

import { useNotifications } from '@/Composables/Notification';

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

const {
  notifications,
  notificationsTotal,
  notification,
  getNotifications,
  getNotification,
  storeNotification,
  destroyNotification
} = useNotifications();

onMounted(() => getNotifications({}));
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

          <div class="hidden sm:flex sm:items-center gap-5 sm:ml-6">
            <Dropdown align="right" width="400">
              <template #trigger>
                <button
                  type="button"
                  class="inline-flex relative items-center p-3 text-sm font-medium text-center text-white rounded-lg"
                >
                  <BellAlertIcon
                    v-if="notificationsTotal > 10"
                    class="w-6 h-6"
                  />
                  <BellIcon v-else class="w-6 h-6" />
                  <div
                    class="inline-flex absolute -top-2 -right-2 justify-center items-center w-6 h-6 text-xs font-bold text-white bg-red-500 rounded-full border-2 border-white dark:border-gray-900"
                  >
                    {{ notificationsTotal }}
                  </div>
                </button>
              </template>

              <template #content>
                <DropdownLink
                  v-for="(notif, index) in notifications"
                  v-bind:key="index"
                >
                  <div
                    class="flex items-center p-4 w-full text-gray-500 bg-white rounded-lg shadow dark:text-gray-400 dark:bg-gray-800"
                  >
                    <div
                      class="inline-flex flex-shrink-0 justify-center items-center w-8 h-8 text-blue-500 bg-blue-100 rounded-lg dark:bg-blue-800 dark:text-blue-200"
                    >
                      <svg
                        class="w-5 h-5"
                        fill="currentColor"
                        viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg"
                      >
                        <path
                          fill-rule="evenodd"
                          d="M12.395 2.553a1 1 0 00-1.45-.385c-.345.23-.614.558-.822.88-.214.33-.403.713-.57 1.116-.334.804-.614 1.768-.84 2.734a31.365 31.365 0 00-.613 3.58 2.64 2.64 0 01-.945-1.067c-.328-.68-.398-1.534-.398-2.654A1 1 0 005.05 6.05 6.981 6.981 0 003 11a7 7 0 1011.95-4.95c-.592-.591-.98-.985-1.348-1.467-.363-.476-.724-1.063-1.207-2.03zM12.12 15.12A3 3 0 017 13s.879.5 2.5.5c0-1 .5-4 1.25-4.5.5 1 .786 1.293 1.371 1.879A2.99 2.99 0 0113 13a2.99 2.99 0 01-.879 2.121z"
                          clip-rule="evenodd"
                        ></path>
                      </svg>
                    </div>
                    <div class="ml-3 text-sm font-normal">
                      <h5 class="text-xl font-bold dark:text-white">
                        {{ notif.title }}
                      </h5>
                      {{ notif.body }}
                    </div>
                    <button
                      type="button"
                      class="ml-auto -mx-1.5 -my-1.5 bg-white text-gray-400 hover:text-gray-900 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 hover:bg-gray-100 inline-flex h-8 w-8 dark:text-gray-500 dark:hover:text-white dark:bg-gray-800 dark:hover:bg-gray-700"
                    >
                      <svg
                        class="w-5 h-5"
                        fill="currentColor"
                        viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg"
                      >
                        <path
                          fill-rule="evenodd"
                          d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                          clip-rule="evenodd"
                        ></path>
                      </svg>
                    </button>
                  </div>
                </DropdownLink>
              </template>
            </Dropdown>

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

          <div class="-mr-2 flex items-center sm:hidden gap-3">
            <Dropdown align="right" width="400">
              <template #trigger>
                <button
                  type="button"
                  class="inline-flex relative items-center p-3 text-sm font-medium text-center text-white rounded-lg"
                >
                  <BellAlertIcon
                    v-if="notificationsTotal > 10"
                    class="w-6 h-6"
                  />
                  <BellIcon v-else class="w-6 h-6" />
                  <div
                    class="inline-flex absolute -top-2 -right-2 justify-center items-center w-6 h-6 text-xs font-bold text-white bg-red-500 rounded-full border-2 border-white dark:border-gray-900"
                  >
                    {{ notificationsTotal }}
                  </div>
                </button>
              </template>

              <template #content>
                <DropdownLink
                  v-for="(notif, index) in notifications"
                  v-bind:key="index"
                >
                  <div
                    class="flex items-center p-4 w-full text-gray-500 bg-white rounded-lg shadow dark:text-gray-400 dark:bg-gray-800"
                  >
                    <div
                      class="inline-flex flex-shrink-0 justify-center items-center w-8 h-8 text-blue-500 bg-blue-100 rounded-lg dark:bg-blue-800 dark:text-blue-200"
                    >
                      <svg
                        class="w-5 h-5"
                        fill="currentColor"
                        viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg"
                      >
                        <path
                          fill-rule="evenodd"
                          d="M12.395 2.553a1 1 0 00-1.45-.385c-.345.23-.614.558-.822.88-.214.33-.403.713-.57 1.116-.334.804-.614 1.768-.84 2.734a31.365 31.365 0 00-.613 3.58 2.64 2.64 0 01-.945-1.067c-.328-.68-.398-1.534-.398-2.654A1 1 0 005.05 6.05 6.981 6.981 0 003 11a7 7 0 1011.95-4.95c-.592-.591-.98-.985-1.348-1.467-.363-.476-.724-1.063-1.207-2.03zM12.12 15.12A3 3 0 017 13s.879.5 2.5.5c0-1 .5-4 1.25-4.5.5 1 .786 1.293 1.371 1.879A2.99 2.99 0 0113 13a2.99 2.99 0 01-.879 2.121z"
                          clip-rule="evenodd"
                        ></path>
                      </svg>
                    </div>
                    <div class="ml-3 text-sm font-normal">
                      {{ notif.body }}
                    </div>
                    <button
                      type="button"
                      class="ml-auto -mx-1.5 -my-1.5 bg-white text-gray-400 hover:text-gray-900 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 hover:bg-gray-100 inline-flex h-8 w-8 dark:text-gray-500 dark:hover:text-white dark:bg-gray-800 dark:hover:bg-gray-700"
                    >
                      <svg
                        class="w-5 h-5"
                        fill="currentColor"
                        viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg"
                      >
                        <path
                          fill-rule="evenodd"
                          d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                          clip-rule="evenodd"
                        ></path>
                      </svg>
                    </button>
                  </div>
                </DropdownLink>
              </template>
            </Dropdown>

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
        <h2
          class="font-semibold text-2xl md:text-3xl lg:text-4xl text-gray-800 dark:text-white leading-tight uppercase"
        >
          <slot name="header" />
        </h2>
      </div>
    </header>

    <main class="max-w-7xl min-h-[70vh] mb-4 mx-auto px-4 sm:px-6 lg:px-8">
      <div
        class="overflow-hidden bg-white dark:bg-gray-700 rounded-lg py-4 px-4 dark:bg-gray-800"
      >
        <slot />
      </div>
    </main>

    <footer
      class="p-4 bg-white md:flex md:items-center md:justify-between md:p-6 dark:bg-gray-800"
    >
      <span class="text-sm text-gray-500 sm:text-center dark:text-gray-400">
        © {{ new Date().getFullYear() }}
        <a href="#" class="hover:underline">MAGicle™</a>. All Rights Reserved.
      </span>
      <ul
        class="flex flex-wrap items-center mt-3 text-sm text-gray-500 dark:text-gray-400 sm:mt-0"
      >
        <li>
          <a
            target="_blank"
            href="https://git.mif.vu.lt/mipu7431/data-source-manager/-/blob/master/README.md"
            class="mr-4 hover:underline md:mr-6"
          >
            About
          </a>
        </li>
        <li>
          <a
            target="_blank"
            href="https://git.mif.vu.lt/mipu7431/data-source-manager/-/blob/master/CONTRIBUTING.md"
            class="mr-4 hover:underline md:mr-6"
          >
            Contributing
          </a>
        </li>
        <li>
          <a
            target="_blank"
            href="mailto:mikas.pupeikis@mif.stud.vu.lt"
            class="hover:underline"
          >
            Contact
          </a>
        </li>
      </ul>
    </footer>
  </div>
</template>
