<script setup>
import { ref } from 'vue';
import { ChevronDownIcon } from '@heroicons/vue/24/solid';

const showingNavigationDropdown = ref(false);

const items = [
  {
    title: 'Library',
    icon: 'folder',
    pathName: 'libraryIndex'
  },
  {
    title: 'Collections',
    icon: 'collections_bookmark',
    pathName: 'collections'
  },
  {
    title: 'Groups',
    icon: 'groups',
    pathName: 'groupsIndex'
  },
  {
    title: 'Profile',
    icon: 'account_circle',
    pathName: 'profileShow'
  },
  {
    title: 'Settings',
    icon: 'settings',
    pathName: 'settings'
  }
];
</script>
<template>
  <div>
    <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
      <nav class="bg-white border-b border-gray-100">
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
                        class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150"
                      >
                        {{ $page.props.auth.user.first_name }}
                        {{ $page.props.auth.user.last_name }}

                        <ChevronDownIcon class="h-5 w-5" />
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
                <MenuAlt v-if="!showingNavigationDropdown" class="h-6 w-6" />
                <Close v-else class="h-6 w-6" />
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

      <header class="bg-white shadow" v-if="$slots.header">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
          <slot name="header" />
          <ThemeToggle />
        </div>
      </header>

      <main>
        <slot />
      </main>
    </div>
  </div>
</template>
