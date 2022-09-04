<script setup>
defineProps({
  type: {
    type: String,
    default: 'submit'
  },
  rounded: false
});
</script>

<template>
  <button
    class="inline-flex items-center font-medium border"
    :type="type"
    :class="
      rounded
        ? 'text-blue-700 border-blue-700 hover:bg-blue-700 hover:text-white rounded-full text-sm p-2.5 text-center dark:border-blue-500 dark:text-blue-500 dark:hover:text-white'
        : 'text-gray-900 bg-white border-gray-300 hover:bg-gray-100 rounded-lg text-sm px-5 py-2.5 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600'
    "
  >
    <slot />
  </button>
</template>
