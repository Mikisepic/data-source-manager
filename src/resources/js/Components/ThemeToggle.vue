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
      v-model="enabledDarkMode"
      type="checkbox"
      @change="toggleDarkMode()"
      id="darkModelToggle"
      class="sr-only peer"
    />
    <div
      class="w-11 h-6 bg-gray-500 focus:outline-none rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600"
    ></div>
  </label>
</template>
