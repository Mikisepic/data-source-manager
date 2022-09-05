<script setup>
import { ref } from 'vue';
import { TabGroup, TabList, Tab, TabPanels, TabPanel } from '@headlessui/vue';

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

          <div v-if="category.shortName === Category.INTERFACE">
            <ThemeToggle />
          </div>
        </TabPanel>
      </TabPanels>
    </TabGroup>
  </AuthenticatedLayout>
</template>
