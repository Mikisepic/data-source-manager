<script setup>
defineProps(['message']);
</script>

<template>
  <div v-show="message">
    <p class="mt-2 text-sm text-red-600 dark:text-red-500">
      {{ message }}
    </p>
  </div>
</template>
