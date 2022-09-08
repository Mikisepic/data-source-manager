<script setup>
import { XMarkIcon } from '@heroicons/vue/24/solid';

defineProps({
  isOpen: Boolean
});
</script>
<template>
  <div
    class="bg-opacity-25 overflow-y-auto overflow-x-hidden fixed z-50 w-full md:inset-0 h-modal md:h-full"
    :class="!isOpen ? 'hidden' : ''"
  >
    <div class="relative p-4 w-full max-w-md mx-auto h-full md:h-auto">
      <div
        class="relative bg-white rounded-lg border border-gray-800 shadow dark:bg-gray-700 dark:border-gray-400"
      >
        <div class="py-6 px-6 lg:px-8">
          <h3
            class="mb-4 flex align-center justify-around text-xl font-medium text-gray-900 dark:text-white"
          >
            <slot name="title" />
            <button
              type="button"
              @click="$emit('closeDialog')"
              class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white"
            >
              <XMarkIcon class="w-5 h-5" />
            </button>
          </h3>

          <slot />
        </div>
      </div>
    </div>
  </div>
</template>
