<script setup>
import { ref } from '@vue/runtime-core';

const enabledDarkMode = ref(
  document.documentElement.classList.contains('dark')
);

const toggleDarkMode = () => {
  document.documentElement.classList.toggle('dark');

  localStorage.setItem(
    'isDark',
    document.documentElement.classList.contains('dark')
  );
};
</script>
<template>
  <label
    for="darkModelToggle"
    class="inline-flex relative items-center cursor-pointer"
  >
    <input
      type="checkbox"
      v-model="enabledDarkMode"
      @change="toggleDarkMode()"
      id="darkModelToggle"
      class="sr-only peer"
    />
    <div
      class="w-14 h-7 bg-gray-600 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:left-[4px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-6 after:w-6 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600"
    ></div>
    <span class="ml-3 text-md font-medium text-gray-900 dark:text-gray-300">
      Enable Dark Mode
    </span>
  </label>
</template>
