<script setup>
import { ref } from 'vue';
import { TabGroup, TabList, Tab, TabPanels, TabPanel } from '@headlessui/vue';

const categories = ref([
  {
    id: 1,
    title: 'Account Settings'
  },
  {
    id: 2,
    title: 'Login & Security'
  },
  {
    id: 3,
    title: 'Notification Settings'
  },
  {
    id: 4,
    title: 'Interface'
  },
  {
    id: 5,
    title: 'Other Settings'
  }
]);
</script>

<template>
  <AuthenticatedLayout>
    <Head title="Settings" />

    <template #header>
      <h2
        class="font-semibold text-xl text-gray-800 dark:text-white leading-tight"
      >
        Settings
      </h2>
    </template>

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
              selected ? 'bg-white shadow shadow-indigo-400' : 'text-gray-800'
            ]"
          >
            <h1 class="text-xl text-gray-900 dark:text-white">
              {{ category.title }}
            </h1>
          </button>
        </Tab>
      </TabList>

      <TabPanels class="mt-2">
        <TabPanel
          v-for="(category, index) in categories"
          :key="index"
          :class="[
            'rounded-xl bg-white p-3',
            'ring-white ring-opacity-60 ring-offset-2 ring-offset-blue-400 focus:outline-none focus:ring-2'
          ]"
        >
          <h1
            class="mb-4 text-xl font-bold tracking-tight leading-none text-gray-900 md:text-5xl lg:text-6xl dark:text-white"
          >
            {{ category.title }}
          </h1>
        </TabPanel>
      </TabPanels>
    </TabGroup>
  </AuthenticatedLayout>
</template>
