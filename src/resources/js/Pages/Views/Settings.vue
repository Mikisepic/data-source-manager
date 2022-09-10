<script setup>
import { TabGroup, TabList, Tab, TabPanels, TabPanel } from '@headlessui/vue';
import {
  LightBulbIcon,
  ArrowTopRightOnSquareIcon
} from '@heroicons/vue/24/outline';
import { ref } from '@vue/runtime-core';

const Category = Object.freeze({
  LOGIN: 'login',
  NOTIFICATIONS: 'notifications',
  INTERFACE: 'interface'
});

const categories = ref([
  {
    id: 1,
    shortName: Category.LOGIN,
    title: 'Login & Security'
  },
  {
    id: 2,
    shortName: Category.NOTIFICATIONS,
    title: 'Notification Settings'
  },
  {
    id: 3,
    shortName: Category.INTERFACE,
    title: 'Interface'
  }
]);
</script>

<template>
  <AuthenticatedLayout>
    <Head title="Settings" />

    <template #header> Settings </template>

    <TabGroup>
      <TabList class="flex space-x-1 rounded-xl p-1">
        <Tab
          v-for="(category, index) in categories"
          as="template"
          :key="index"
          v-slot="{ selected }"
        >
          <button
            :class="[
              'w-full rounded-lg py-2.5 text-sm font-medium leading-5 text-blue-700',
              'focus:outline-none',
              selected
                ? 'bg-white dark:bg-gray-800 shadow shadow-indigo-400'
                : 'text-gray-800'
            ]"
          >
            <h1
              class="sm:text-sm md:text-md lg:text-lg text-gray-900 dark:text-white"
            >
              {{ category.title }}
            </h1>
          </button>
        </Tab>
      </TabList>

      <TabPanels class="mt-2">
        <TabPanel
          v-for="(category, index) in categories"
          :key="index"
          class="rounded-xl bg-gray-100 dark:bg-gray-800 p-3"
        >
          <h1
            class="mb-4 text-2xl font-bold tracking-tight leading-none text-gray-900 md:text-5xl lg:text-6xl dark:text-white"
          >
            {{ category.title }}
          </h1>

          <div v-if="category.shortName === Category.LOGIN">
            <div class="my-4">
              <h4 class="text-3xl mt-4 font-bold dark:text-white">
                Reset your password
              </h4>

              <p class="text-gray-500 dark:text-gray-400">
                In case you need to reset your password, you are always able to
                do so
                <Link
                  :href="route('password.request')"
                  class="inline-flex items-center font-medium text-blue-600 dark:text-blue-500 hover:underline"
                >
                  here.
                  <ArrowTopRightOnSquareIcon class="w-5 h-5" />
                </Link>
              </p>
            </div>

            <div>
              <h4 class="text-3xl font-bold dark:text-white">Delete account</h4>
            </div>
          </div>

          <div v-if="category.shortName === Category.INTERFACE">
            <h4 class="text-3xl my-4 font-bold dark:text-white">
              Theme Select
            </h4>

            <ThemeToggle />

            <div class="flex gap-10 mt-5">
              <div
                class="bg-white rounded-lg px-6 py-8 border border-gray-400 shadow-xl"
              >
                <div>
                  <span
                    class="inline-flex items-center justify-center p-2 bg-indigo-500 rounded-md shadow-lg"
                  >
                    <LightBulbIcon class="w-7 h-7 text-white" />
                  </span>
                </div>
                <h3
                  class="text-gray-900 mt-5 text-base font-medium tracking-tight"
                >
                  MAGicle Light Mode
                </h3>
                <p class="text-gray-900 mt-2 text-md">
                  Lorem ipsum, dolor sit amet consectetur adipisicing elit.
                  Maiores impedit perferendis suscipit eaque, iste dolor
                  cupiditate blanditiis ratione.
                </p>
              </div>

              <div
                class="bg-gray-800 rounded-lg px-6 py-8 border border-gray-400 shadow-xl"
              >
                <div>
                  <span
                    class="inline-flex items-center justify-center p-2 bg-indigo-500 rounded-md shadow-lg"
                  >
                    <LightBulbIcon class="w-7 h-7 text-white" />
                  </span>
                </div>
                <h3
                  class="text-white mt-5 text-base font-medium tracking-tight"
                >
                  MAGicle Dark Mode
                </h3>
                <p class="text-gray-300 mt-2 text-md">
                  Lorem ipsum, dolor sit amet consectetur adipisicing elit.
                  Maiores impedit perferendis suscipit eaque, iste dolor
                  cupiditate blanditiis ratione.
                </p>
              </div>
            </div>
          </div>
        </TabPanel>
      </TabPanels>
    </TabGroup>
  </AuthenticatedLayout>
</template>
