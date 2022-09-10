<script setup>
import { XMarkIcon } from '@heroicons/vue/24/solid';

defineProps({
  isOpen: Boolean,
  goBackTo: {
    type: String,
    default: 'libraryIndex'
  },
  goBackToId: {
    type: String,
    default: undefined
  }
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
            class="mb-4 flex align-center justify-between text-xl font-medium text-gray-900 dark:text-white"
          >
            <slot name="title" />
            <Link :href="route(goBackTo, goBackToId)">
              <XMarkIcon
                class="w-7 h-7 cursor-pointer text-gray-400 bg-transparent hover:text-gray-600 hover:text-gray-900 dark:hover:text-gray-200"
                @click="$emit('closeDialog')"
              />
            </Link>
          </h3>

          <slot />
        </div>
      </div>
    </div>
  </div>
</template>
