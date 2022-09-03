<script setup>
import { usePage } from '@inertiajs/inertia-vue3';
import { computed, onMounted, reactive, ref } from '@vue/runtime-core';
import {
  PlusIcon,
  PencilSquareIcon,
  ArrowRightOnRectangleIcon,
  EyeIcon
} from '@heroicons/vue/24/outline';

import { useGroups } from '@/Composables/Groups';

const {
  group,
  groups,
  groupMeta,
  groupLinks,
  errors,
  getGroups,
  getGroup,
  storeGroup,
  destroyGroup
} = useGroups();

const saveGroup = async () => {
  await storeGroup({ ...form });
  getGroups();

  if (!!!errors.value) {
    closeModal();
  }
};

const deleteGroup = async (id) => {
  await destroyGroup(id);
  await getGroups();
};

onMounted(() => {
  getGroups();
});

const user = computed(() => usePage().props.value.auth.user);

const form = reactive({
  user_id: user.value.id,
  title: '',
  description: ''
});

const isOpen = ref(false);
const openModal = () => (isOpen.value = true);
const closeModal = () => {
  isOpen.value = false;
};
</script>
<template>
  <AuthenticatedLayout>
    <Head title="Groups" />

    <template #header>
      <h2
        class="font-semibold text-xl text-gray-800 dark:text-white leading-tight"
      >
        Groups
      </h2>
    </template>

    <div class="flex items-center justify-end mb-4">
      <Button type="button" :rounded="true" @click="openModal">
        <PlusIcon class="w-5 h-5" />
      </Button>
    </div>

    <div class="flex flex-wrap w-full gap-10">
      <Link
        class="group block divide-y divide-gray-100 p-6 max-w-xs bg-white rounded-lg border border-gray-200 shadow-md hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700 dark:divide-gray-600"
        v-for="group in groups"
        v-bind:key="group.id"
        :href="route('groupShow', group.id)"
      >
        <h5
          class="mb-2 text-2xl h-20 overflow-hidden break-all text-ellipsis font-bold tracking-tight text-gray-900 dark:text-white"
        >
          {{ group.title }}
        </h5>

        <div class="flex justify-between">
          <h5
            class="mb-2 text-md font-bold tracking-tight text-gray-900 dark:text-white"
          >
            Last instance:
          </h5>
          <span
            class="font-normal w-20 h-20 overflow-hidden break-all text-ellipsis text-gray-700 dark:text-gray-400"
          >
            {{ group.title }}
          </span>
        </div>

        <div class="flex justify-between">
          <h5
            class="mb-2 text-md font-bold tracking-tight text-gray-900 dark:text-white"
          >
            Last updated:
          </h5>
          <span
            class="font-normal w-20 text-gray-700 dark:text-gray-400 break-all"
          >
            {{ group.updated_at }}
          </span>
        </div>

        <div class="text-gray-700 dark:text-white flex justify-evenly pt-3">
          <PencilSquareIcon class="h-7 w-7" />
          <EyeIcon class="h-7 w-7" />
          <ArrowRightOnRectangleIcon
            class="h-7 w-7 text-red-700 hover:text-red-800 dark:text-red-600 dark:hover:text-red-700"
          />
        </div>
      </Link>
    </div>

    <Pagination
      :meta="{
        from: groupMeta.from,
        to: groupMeta.to,
        total: groupMeta.total,
        current_page: groupMeta.current_page,
        last_page: groupMeta.last_page
      }"
      routeName="groupIndex"
    />

    <SharedDialog :isOpen="isOpen" @closeDialog="closeModal">
      <template #title>Create a New Instance</template>

      <form class="mt-2" @submit.prevent="saveGroup">
        <div>
          <Label for="title" value="Title" />
          <Input
            id="title"
            type="text"
            class="mt-1 block w-full"
            v-model="form.title"
          />
          <InputError class="mt-2" :message="errors?.title" />
        </div>

        <div class="mt-4">
          <Label for="description" value="Description" />
          <Input
            id="description"
            type="text"
            class="mt-1 block w-full"
            v-model="form.description"
          />
          <InputError class="mt-2" :message="errors?.description" />
        </div>

        <div class="flex items-center justify-end mt-4">
          <Button
            class="inline-flex justify-center rounded-md border border-transparent bg-blue-100 px-4 py-2 text-sm font-medium text-blue-900 hover:bg-blue-200 focus:outline-none focus-visible:ring-2 focus-visible:ring-blue-500 focus-visible:ring-offset-2"
            :class="{ 'opacity-25': form.processing }"
            :disabled="form.processing"
          >
            Create
          </Button>
        </div>
      </form>
    </SharedDialog>
  </AuthenticatedLayout>
</template>
<style scoped>
.group {
  max-width: 250px;
}
</style>
