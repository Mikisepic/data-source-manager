<script setup>
import {
  ChevronDownIcon,
  Bars3BottomRightIcon,
  XMarkIcon,
  BellIcon,
  BellAlertIcon,
  CheckIcon
} from '@heroicons/vue/24/outline';
import { onMounted, onUpdated, ref } from '@vue/runtime-core';

import { useNotifications } from '@/Composables/Notifications';

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
  getNotifications,
  destroyNotification
} = useNotifications();

const deleteNotification = async (id) => {
  await destroyNotification(id);
  getNotifications({});
};

onMounted(() => getNotifications({}));
onUpdated(() => getNotifications({}));
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
            <Dropdown align="right" width="400">
              <template #trigger>
                <button
                  type="button"
                  class="inline-flex relative items-center p-3 text-sm font-medium text-center text-gray-600 rounded-lg text-gray-500 dark:text-white hover:text-gray-900"
                >
                  <BellAlertIcon
                    v-if="notificationsTotal > 10"
                    class="w-6 h-6"
                  />
                  <BellIcon v-else class="w-6 h-6" />
                  <div
                    v-if="notificationsTotal > 0"
                    class="inline-flex absolute -top-1 -right-2 justify-center items-center w-6 h-6 text-xs font-bold text-white bg-red-500 rounded-full border-2 border-white dark:border-gray-900"
                  >
                    {{ notificationsTotal }}
                  </div>
                </button>
              </template>

              <template #content>
                <div v-if="notificationsTotal > 0">
                  <DropdownItem
                    v-for="(notification, index) in notifications"
                    v-bind:key="index"
                  >
                    <div
                      class="flex items-top p-4 w-full text-gray-500 bg-white rounded-lg shadow dark:text-gray-400 dark:bg-gray-800"
                    >
                      <NotificationIcon :type="notification.type" />
                      <div class="ml-3 text-sm font-normal">
                        <h5 class="text-xl font-bold dark:text-white">
                          {{ notification.title }}
                        </h5>
                        <p
                          class="mt-1 font-light text-gray-500 dark:text-gray-400"
                          v-html="notification.body"
                        ></p>
                      </div>
                      <button
                        type="button"
                        @click="deleteNotification(notification.id)"
                        class="ml-auto -mx-1.5 -my-1.5 text-gray-400 hover:text-gray-900 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 inline-flex h-8 w-8 dark:text-gray-500 dark:hover:text-white"
                      >
                        <XMarkIcon class="w-5 h-5" />
                      </button>
                    </div>
                  </DropdownItem>
                </div>
                <DropdownItem v-else>
                  <h5 class="text-xl text-center font-bold dark:text-white">
                    You're all caught up!
                  </h5>
                </DropdownItem>
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
                  class="inline-flex relative items-center p-3 text-sm font-medium text-center text-gray-600 rounded-lg text-gray-500 dark:text-white hover:text-gray-900"
                >
                  <BellAlertIcon
                    v-if="notificationsTotal > 10"
                    class="w-6 h-6"
                  />
                  <BellIcon v-else class="w-6 h-6" />
                  <div
                    v-if="notificationsTotal > 0"
                    class="inline-flex absolute -top-1 -right-2 justify-center items-center w-6 h-6 text-xs font-bold text-white bg-red-500 rounded-full border-2 border-white dark:border-gray-900"
                  >
                    {{ notificationsTotal }}
                  </div>
                </button>
              </template>

              <template #content>
                <div v-if="notificationsTotal > 0">
                  <DropdownItem
                    v-for="(notification, index) in notifications"
                    v-bind:key="index"
                  >
                    <div
                      class="flex items-top p-4 w-full text-gray-500 bg-white rounded-lg shadow dark:text-gray-400 dark:bg-gray-800"
                    >
                      <NotificationIcon :type="notification.type" />
                      <div class="ml-3 text-sm font-normal">
                        <h5 class="text-xl font-bold dark:text-white">
                          {{ notification.title }}
                        </h5>
                        <p
                          class="mt-1 font-light text-gray-500 dark:text-gray-400"
                          v-html="notification.body"
                        ></p>
                      </div>
                      <button
                        type="button"
                        @click="deleteNotification(notification.id)"
                        class="ml-auto -mx-1.5 -my-1.5 text-gray-400 hover:text-gray-900 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 inline-flex h-8 w-8 dark:text-gray-500 dark:hover:text-white"
                      >
                        <XMarkIcon class="w-5 h-5" />
                      </button>
                    </div>
                  </DropdownItem>
                </div>
                <DropdownItem v-else>
                  <h5 class="text-xl text-center font-bold dark:text-white">
                    You're all caught up!
                  </h5>
                </DropdownItem>
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

    <main class="max-w-7xl min-h-[76vh] mb-4 mx-auto px-4 sm:px-6 lg:px-8">
      <div
        class="overflow-hidden bg-white dark:bg-gray-700 rounded-lg py-4 px-4 dark:bg-gray-800"
      >
        <slot />
      </div>
    </main>

    <footer class="text-center bg-white dark:bg-gray-800">
      <div
        class="max-w-7xl mx-auto p-4 md:flex md:items-center md:justify-between md:p-6"
      >
        <span class="text-sm text-gray-500 sm:text-center dark:text-gray-400">
          © {{ new Date().getFullYear() }}
          <a href="#" class="hover:underline">MAGicle™</a>. All Rights Reserved.
        </span>
        <ul
          class="flex flex-wrap items-center justify-center mt-3 text-sm text-gray-500 dark:text-gray-400 sm:mt-0"
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
      </div>
    </footer>
  </div>
</template>
