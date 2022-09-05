<script setup>
import { usePage } from '@inertiajs/inertia-vue3';
import { computed, onMounted, reactive, ref } from '@vue/runtime-core';
import {
  PlusIcon,
  PencilSquareIcon,
  ArrowRightOnRectangleIcon,
  EyeIcon,
  UserIcon
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

    <template #header>Groups</template>

    <div class="flex items-center justify-end mb-4">
      <Button type="button" :rounded="true" @click="openModal">
        <PlusIcon class="w-5 h-5" />
      </Button>
    </div>

    <div v-if="groupMeta.total > 0">
      <div class="flex flex-wrap w-full gap-10">
        <div
          class="group block divide-y divide-gray-100 p-6 max-w-xs bg-white rounded-lg border border-gray-200 shadow-md hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700 dark:divide-gray-600"
          v-for="group in groups"
          v-bind:key="group.id"
        >
          <Link :href="route('groupShow', group.id)">
            <h5
              class="mb-2 text-xl h-20 overflow-hidden break-all text-ellipsis font-bold tracking-tight text-gray-900 dark:text-white"
            >
              {{ group.title }}
            </h5>

            <div class="flex mb-5 -space-x-4">
              <div
                v-for="(user, index) of group.members_count > 5
                  ? 5
                  : group.members_count"
                v-bind:key="index"
                class="flex justify-center items-center w-10 h-10 text-xs rounded-full border-2 border-white font-medium text-white transition ease-in-out delay-50 hover:-translate-y-1 hover:scale-120 bg-gray-700 hover:bg-gray-600 dark:border-gray-800"
              >
                <UserIcon class="w-5 w-5" />
              </div>
              <a
                class="flex justify-center items-center w-10 h-10 text-xs font-medium text-white bg-gray-700 rounded-full border-2 border-white hover:bg-gray-600 dark:border-gray-800"
                href="#"
                v-if="group.members_count > 5"
              >
                +{{ group.members_count - 5 }}
              </a>
            </div>

            <div class="flex justify-between gap-3">
              <h5
                class="mb-2 text-md font-bold tracking-tight text-gray-900 dark:text-white"
              >
                Last updated:
              </h5>
              <span
                class="font-normal w-20 text-gray-700 dark:text-gray-400 break-all"
              >
                {{ $dateDifference(group.updated_at) }}
              </span>
            </div>
          </Link>
          <div class="text-gray-700 dark:text-white flex justify-evenly pt-3">
            <PencilSquareIcon class="h-7 w-7" />
            <EyeIcon class="h-7 w-7" />
            <ArrowRightOnRectangleIcon
              class="h-7 w-7 text-red-700 hover:text-red-800 dark:text-red-600 dark:hover:text-red-700"
            />
          </div>
        </div>
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
    </div>

    <div v-else class="sm:px-16 xl:px-38">
      <h1
        class="mb-4 text-4xl font-extrabold tracking-tight text-gray-900 md:text-4xl lg:text-5xl dark:text-white"
      >
        Looks like there are no records here...
      </h1>
      <p
        class="mb-6 text-lg font-normal text-gray-500 lg:text-xl dark:text-gray-400"
      >
        You currently have no instances of this type. Feel free to create one,
        or two...
      </p>
      <div class="w-full inline-flex justify-end items-center">
        <Button
          type="button"
          class="py-3 px-5 text-base font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800"
          @click="openModal"
        >
          Create an instance
        </Button>
      </div>
    </div>

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
