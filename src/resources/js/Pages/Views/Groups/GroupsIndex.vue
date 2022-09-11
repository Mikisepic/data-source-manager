<script setup>
import {
  PlusIcon,
  PencilSquareIcon,
  ArrowRightOnRectangleIcon,
  EyeIcon,
  UserIcon,
  MagnifyingGlassIcon
} from '@heroicons/vue/24/outline';
import { usePage } from '@inertiajs/inertia-vue3';
import { computed, onMounted, reactive, ref } from '@vue/runtime-core';

import { useGroups } from '@/Composables/Groups';
import { useNotifications } from '@/Composables/Notifications';

const url = new URL(window.location);
const groupId = url.pathname.split('/')[2];

const searchQuery = ref('');

const isOpen = ref(false);
const openCreateDialog = ref(false);
const openPreviewDialog = computed(
  () => usePage().props.value.openPreviewDialog
);
const openDeleteConfirmationDialog = computed(
  () => usePage().props.value.openDeleteConfirmationDialog
);

const form = reactive({
  title: '',
  description: ''
});

const { storeNotification } = useNotifications();

const pushNotification = async (info) => {
  await storeNotification({ ...info });
};

const {
  group,
  groups,
  groupMeta,
  errors,
  getGroups,
  getGroup,
  storeGroup,
  updateGroup,
  destroyGroup
} = useGroups();

const createGroup = async () => {
  await storeGroup({ ...form });

  if (!!!errors.value) {
    pushNotification({
      type: 'create',
      title: 'Group Created',
      body: `Group <span class="font-extrabold">${form.title}</span> has been created`
    });

    closeModal();
  }
};

const saveGroup = async () => {
  await updateGroup(groupId);

  if (!!!errors.value) {
    pushNotification({
      type: 'update',
      title: 'Group Updated',
      body: `Group <span class="font-extrabold">${group.value.title}</span> has been updated`
    });

    closeModal();
  }
};

const deleteGroup = async () => {
  await destroyGroup(groupId);

  if (!!!errors.value) {
    pushNotification({
      type: 'delete',
      title: 'Group Deleted',
      body: `Group <span class="font-extrabold">${group.value.title}</span> has been deleted`
    });

    closeModal();
  }
};

onMounted(() => {
  getGroups({});

  if (openPreviewDialog.value || openDeleteConfirmationDialog.value) {
    getGroup(groupId);
    isOpen.value = true;
  }
});

const resetFormValues = () => {
  form.title = '';
  form.description = '';
};

const closeModal = () => {
  isOpen.value = false;
  openCreateDialog.value = false;

  resetFormValues();
  getGroups({});
};
</script>
<template>
  <AuthenticatedLayout>
    <Head title="Groups" />

    <template #header>Groups</template>

    <div class="flex items-center justify-between mb-4">
      <div class="flex items-center gap-5">
        <Input type="text" v-model="searchQuery" />

        <Link
          :href="
            route('groupIndex', {
              search: searchQuery
            })
          "
        >
          <MagnifyingGlassIcon class="w-5 h-5" />
        </Link>
      </div>

      <Button
        type="button"
        :rounded="true"
        @click="
          () => {
            isOpen = true;
            openCreateDialog = true;
          }
        "
      >
        <PlusIcon class="w-5 h-5" />
      </Button>
    </div>

    <div v-if="groupMeta.total > 0">
      <div class="flex justify-center flex-wrap w-full gap-10">
        <div
          class="group block divide-y divide-gray-100 p-6 max-w-xs bg-white rounded-lg border border-gray-400 shadow-md hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-900 dark:hover:bg-gray-700 dark:divide-gray-600"
          v-for="group in groups"
          v-bind:key="group.id"
        >
          <Link :href="route('groupShow', group.id)">
            <h5
              class="mb-2 text-2xl h-20 overflow-hidden break-all text-ellipsis font-bold tracking-tight text-gray-900 dark:text-white"
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

            <div class="flex justify-between mb-2">
              <h5
                class="mb-2 w-[150px] text-md font-bold tracking-tight text-gray-900 dark:text-white"
              >
                Last Updated
              </h5>
              <span
                class="font-normal text-right text-sm text-gray-700 dark:text-gray-400 break-all"
                v-html="$dateDifference(group.updated_at)"
              >
              </span>
            </div>
          </Link>
          <div class="text-gray-700 dark:text-white flex justify-evenly pt-3">
            <Link :href="route('groupPreview', group.id)">
              <PencilSquareIcon class="h-7 w-7" />
            </Link>
            <Link :href="route('groupShow', group.id)">
              <EyeIcon class="h-7 w-7" />
            </Link>
            <Link :href="route('groupDelete', group.id)">
              <ArrowRightOnRectangleIcon
                class="h-7 w-7 text-red-700 hover:text-red-800 dark:text-red-600 dark:hover:text-red-700"
              />
            </Link>
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
          @click="
            () => {
              isOpen = true;
              openCreateDialog = true;
            }
          "
        >
          Create an instance
        </Button>
      </div>
    </div>

    <SharedDialog
      :isOpen="isOpen && openCreateDialog"
      goBackTo="groupIndex"
      @closeDialog="closeModal"
    >
      <template #title>Add a New Group</template>

      <form class="mt-2" @submit.prevent="createGroup">
        <div>
          <Label for="title" value="Title" />
          <Input
            id="title"
            type="text"
            class="mt-1 block w-full"
            v-model="form.title"
          />
          <InputError
            v-if="!!errors.title"
            class="mt-2"
            :message="errors.title[0]"
          />
        </div>

        <div class="mt-4">
          <Label for="description" value="Description" />
          <Input
            id="description"
            type="text"
            class="mt-1 block w-full"
            v-model="form.description"
          />
          <InputError
            v-if="!!errors.description"
            class="mt-2"
            :message="errors.description[0]"
          />
        </div>

        <div class="flex items-center justify-end mt-4 gap-5">
          <Button
            @click="closeModal"
            type="button"
            class="inline-flex justify-center rounded-md border border-transparent bg-blue-100 px-4 py-2 text-sm font-medium text-blue-900 hover:bg-blue-200 focus:outline-none focus-visible:ring-2 focus-visible:ring-blue-500 focus-visible:ring-offset-2"
          >
            Cancel
          </Button>
          <Button
            class="inline-flex justify-center rounded-md border border-transparent bg-blue-100 px-4 py-2 text-sm font-medium text-blue-900 hover:bg-blue-200 focus:outline-none focus-visible:ring-2 focus-visible:ring-blue-500 focus-visible:ring-offset-2"
          >
            Create
          </Button>
        </div>
      </form>
    </SharedDialog>

    <SharedDialog
      :isOpen="openPreviewDialog && isOpen"
      goBackTo="groupIndex"
      @closeDialog="closeModal"
    >
      <template #title>Update Group</template>

      <form class="mt-2" @submit.prevent="saveGroup">
        <div>
          <Label for="title" value="Title" />
          <Input
            id="title"
            type="text"
            class="mt-1 block w-full"
            v-model="group.title"
          />
          <InputError
            v-if="!!errors.title"
            class="mt-2"
            :message="errors.title"
          />
        </div>

        <div class="mt-4">
          <Label for="description" value="Description" />
          <Input
            id="description"
            type="text"
            class="mt-1 block w-full"
            v-model="group.description"
          />
          <InputError
            v-if="!!errors.description"
            class="mt-2"
            :message="errors.description[0]"
          />
        </div>

        <div class="flex items-center justify-end mt-4 gap-5">
          <Link :href="route('groupIndex')" @click="closeModal">
            <Button
              class="inline-flex justify-center rounded-md border border-transparent bg-blue-100 px-4 py-2 text-sm font-medium text-blue-900 hover:bg-blue-200 focus:outline-none focus-visible:ring-2 focus-visible:ring-blue-500 focus-visible:ring-offset-2"
            >
              Cancel
            </Button>
          </Link>
          <Link :href="route('groupIndex')" @click="saveGroup">
            <Button
              class="inline-flex justify-center rounded-md border border-transparent bg-blue-100 px-4 py-2 text-sm font-medium text-blue-900 hover:bg-blue-200 focus:outline-none focus-visible:ring-2 focus-visible:ring-blue-500 focus-visible:ring-offset-2"
            >
              Save
            </Button>
          </Link>
        </div>
      </form>
    </SharedDialog>

    <SharedDialog
      :isOpen="openDeleteConfirmationDialog && isOpen"
      goBackTo="groupIndex"
      @closeDialog="closeModal"
    >
      <template #title>Are you sure you want to Leave this Group?</template>

      <div class="flex items-center justify-end mt-4 gap-5">
        <Link :href="route('groupIndex')" @click="closeModal">
          <Button
            class="inline-flex justify-center rounded-md border border-transparent bg-blue-100 px-4 py-2 text-sm font-medium text-blue-900 hover:bg-blue-200 focus:outline-none focus-visible:ring-2 focus-visible:ring-blue-500 focus-visible:ring-offset-2"
          >
            Cancel
          </Button>
        </Link>
        <Link :href="route('groupIndex')" @click="deleteGroup">
          <Button
            class="inline-flex justify-center rounded-md border border-transparent text-red-700 hover:text-white border border-red-700 hover:bg-red-800 dark:border-red-500 dark:text-red-500 dark:hover:text-white dark:hover:bg-red-600"
          >
            Yes, delete
          </Button>
        </Link>
      </div>
    </SharedDialog>
  </AuthenticatedLayout>
</template>
<style scoped>
.group {
  max-width: 250px;
}
</style>
