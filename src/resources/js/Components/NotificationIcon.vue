<script setup>
import {
  ArrowPathIcon,
  CheckIcon,
  ExclaimationTriangleIcon,
  XMarkIcon,
  MinusCircleIcon,
  UserCircleIcon
} from '@heroicons/vue/24/outline';

defineProps({
  type: {
    type: String,
    default: 'create'
  }
});

const NotificationType = Object.freeze({
  CREATE: 'create',
  UPDATE: 'update',
  DELETE: 'delete',
  REMOVE_INSTANCE: 'remove_instance',
  ADD_USER: 'add_user',
  REMOVE_USER: 'remove_user',
  ERROR: 'error'
});
</script>

<template>
  <div
    v-if="type === NotificationType.CREATE"
    class="inline-flex flex-shrink-0 justify-center items-center w-8 h-8 text-green-800 bg-green-300 rounded-lg dark:bg-green-600 dark:text-green-100"
  >
    <CheckIcon class="w-5 h-5" />
  </div>

  <div
    v-else-if="type === NotificationType.ADD_USER"
    class="inline-flex flex-shrink-0 justify-center items-center w-8 h-8 text-green-500 bg-green-100 rounded-lg dark:bg-green-800 dark:text-green-200"
  >
    <CheckIcon class="w-5 h-5" />
  </div>

  <div
    v-else-if="type === NotificationType.UPDATE"
    class="inline-flex flex-shrink-0 justify-center items-center w-8 h-8 text-blue-500 bg-blue-100 rounded-lg dark:bg-blue-800 dark:text-blue-200"
  >
    <ArrowPathIcon class="w-5 h-5" />
  </div>

  <div
    v-else-if="type === NotificationType.DELETE"
    class="inline-flex flex-shrink-0 justify-center items-center w-8 h-8 text-red-800 bg-red-300 rounded-lg dark:bg-red-600 dark:text-red-100"
  >
    <XMarkIcon class="w-5 h-5" />
  </div>

  <div
    v-else-if="type === NotificationType.REMOVE_INSTANCE"
    class="inline-flex flex-shrink-0 justify-center items-center w-8 h-8 text-red-500 bg-red-100 rounded-lg dark:bg-red-800 dark:text-red-200"
  >
    <MinusCircleIcon class="w-5 h-5" />
  </div>

  <div
    v-else-if="type === NotificationType.REMOVE_USER"
    class="inline-flex flex-shrink-0 justify-center items-center w-8 h-8 text-red-500 bg-red-100 rounded-lg dark:bg-red-800 dark:text-red-200"
  >
    <UserCircleIcon class="w-5 h-5" />
  </div>

  <div
    v-else
    class="inline-flex flex-shrink-0 justify-center items-center w-8 h-8 text-orange-500 bg-orange-100 rounded-lg dark:bg-orange-700 dark:text-orange-200"
  >
    <ExclaimationTriangleIcon class="w-5 h-5" />
  </div>
</template>
