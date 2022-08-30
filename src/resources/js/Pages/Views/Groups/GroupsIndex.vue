<script setup>
import { usePage } from '@inertiajs/inertia-vue3';
import { computed, onMounted, reactive, ref } from '@vue/runtime-core';
import { PlusIcon } from '@heroicons/vue/24/solid';

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

    <div class="flex flex-wrap w-full justify-center gap-10">
      <Link
        class="block p-6 max-w-xs bg-white rounded-lg border border-gray-200 shadow-md hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700"
        v-for="group in groups"
        v-bind:key="group.id"
        :href="route('groupShow', group.id)"
      >
        <h5
          class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white"
        >
          {{ group.title }}
        </h5>
        <p class="font-normal text-gray-700 dark:text-gray-400">
          {{ group.description }}
        </p>
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
