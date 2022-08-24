<script setup>
import { ref } from '@vue/runtime-core';

const enabledDarkMode = ref(false);

const toggleDarkMode = function () {
  enabledDarkMode.value
    ? document.documentElement.classList.add('dark')
    : document.documentElement.classList.remove('dark');
};
</script>
<template>
  <label
    for="darkModelToggle"
    class="inline-flex relative items-center mb-4 cursor-pointer"
  >
    <input
      v-model="enabledDarkMode"
      type="checkbox"
      @change="toggleDarkMode()"
      id="darkModelToggle"
      class="sr-only peer"
    />
    <div
      class="w-11 h-6 bg-gray-200 rounded-full peer focus:outline-none dark:bg-gray-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600"
    ></div>
  </label>
</template>
