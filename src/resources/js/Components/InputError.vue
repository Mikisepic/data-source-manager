<script setup>
defineProps(['message']);
</script>

<template>
  <div v-show="message">
    <p class="text-sm text-red-600">
      {{ !!message ? message[0] : '' }}
    </p>
  </div>
</template>
