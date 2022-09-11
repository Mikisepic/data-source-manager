<script setup>
import {
  ChevronDoubleDownIcon,
  XMarkIcon,
  UsersIcon,
  MinusCircleIcon,
  PlusCircleIcon
} from '@heroicons/vue/24/outline';
import { usePage } from '@inertiajs/inertia-vue3';
import { computed, onMounted, reactive, ref } from '@vue/runtime-core';

import { useDataSources } from '@/Composables/DataSources';
import { useGroups } from '@/Composables/Groups';
import { useNotifications } from '@/Composables/Notifications';

const url = new URL(window.location);
const groupId = url.pathname.split('/')[2];
const dataSourceId = url.pathname.split('/')[4];

const isOpen = ref(true);
const openRemoveFromGroupDialog = computed(
  () => usePage().props.value.openRemoveFromGroupDialog
);

const form = reactive({
  username: ''
});

const { storeNotification } = useNotifications();

const pushNotification = async (info) => {
  await storeNotification({ ...info });
};

const {
  errors,
  group,
  groupUsersData,
  getGroup,
  getGroupUsers,
  groupUsersTotal,
  addOrRemoveDataSourceToGroup,
  addOrRemoveUserToGroup
} = useGroups();

const addOrRemoveDataSource = async () => {
  await addOrRemoveDataSourceToGroup(group, dataSourceId, true);

  if (!!!errors.value) {
    pushNotification({
      type: 'remove_instance',
      title: 'Data Source Removed from a Group',
      body: `Data Source <span class="font-extrabold">${dataSource.value.title}</span> has been removed from <span class="font-extrabold">${group.value.title}</span>`
    });

    closeModal();
  }
};

const addUser = async () => {
  await addOrRemoveUserToGroup(groupId, form.username);

  if (!!!errors.value) {
    pushNotification({
      type: 'add_user',
      title: 'User Added to a Group',
      body: `User <span class="font-extrabold">${username}</span> has been added to <span class="font-extrabold">${group.value.title}</span>`
    });

    getDataSources({ groupId });
    getGroupUsers(groupId);
    getGroup(groupId);
  }
};

const removeUser = async (username) => {
  await addOrRemoveUserToGroup(groupId, username, true);

  if (!!!errors.value) {
    pushNotification({
      type: 'remove_user',
      title: 'User Removed from a Group',
      body: `User <span class="font-extrabold">${username}</span> has been removed from <span class="font-extrabold">${group.value.title}</span>`
    });

    getDataSources({ groupId });
    getGroupUsers(groupId);
    getGroup(groupId);
  }
};

const {
  dataSource,
  dataSources,
  dataSourceMeta,
  getDataSources,
  getDataSource
} = useDataSources();

onMounted(() => {
  getDataSources({ groupId });
  getGroupUsers(groupId);
  getGroup(groupId);

  if (openRemoveFromGroupDialog.value) {
    getDataSource(dataSourceId);
  }
});

const closeModal = () => {
  isOpen.value = false;
};
</script>

<template>
  <AuthenticatedLayout>
    <Head title="Preview Group" />

    <template #header>Preview Group</template>

    <div
      class="p-4 mb-6 w-full bg-white rounded-lg border shadow-md sm:p-8 dark:bg-gray-800 dark:border-gray-700"
    >
      <h5 class="text-2xl font-bold leading-none text-gray-900 dark:text-white">
        About the group
      </h5>

      <div class="flex gap-5 flex-col md:flex-row">
        <div class="sm:w-full md:w-1/2">
          <h5
            class="text-2xl mt-5 font-bold leading-none text-gray-900 dark:text-white"
          >
            Title
            <span
              class="text-lg ml-3 font-medium leading-none text-gray-900 dark:text-white"
            >
              {{ group.title }}
            </span>
          </h5>

          <h5
            class="text-2xl mt-5 font-bold leading-none text-gray-900 dark:text-white"
          >
            Description
          </h5>
          <p class="mt-3 text-md font-medium text-gray-500 dark:text-gray-400">
            {{ group.description }}
          </p>
        </div>

        <div class="sm:w-full md:w-1/2">
          <div class="flex items-center justify-between gap-5 px-5 mb-5">
            <div class="flex items-center gap-5">
              <UsersIcon class="w-8 h-8 text-gray-900 dark:text-white" />
              <h5
                class="text-lg font-bold leading-none text-gray-900 dark:text-white"
              >
                {{ groupUsersTotal }}
              </h5>
            </div>
            <div class="flex items-center gap-5">
              <form @submit.prevent="createDataSource">
                <Input id="username" type="text" v-model="form.username" />
              </form>
              <PlusCircleIcon class="w-8 h-8" @click="addUser" />
            </div>
          </div>

          <div
            class="text-gray-900 bg-white rounded-lg border border-gray-200 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
          >
            <Button
              v-for="(groupUser, index) in groupUsersData"
              v-bind:key="index"
              type="button"
              class="inline-flex relative items-center justify-between py-2 px-4 w-full text-md font-medium rounded-t-lg border-b border-gray-200 hover:bg-gray-100 hover:text-blue-700 dark:border-gray-600 dark:hover:bg-gray-600 dark:hover:text-white"
            >
              {{ groupUser.username }}

              <MinusCircleIcon
                @click="removeUser(groupUser.username)"
                class="w-7 h-7 text-red-700 hover:text-red-800 dark:text-red-600 dark:hover:text-red-700"
              />
            </Button>
          </div>
        </div>
      </div>
    </div>

    <div
      v-if="dataSourceMeta.total > 0"
      class="overflow-x-auto sm:-mx-6 lg:-mx-8"
    >
      <div class="py-2 inline-block min-w-full sm:px-6 lg:px-8">
        <table
          class="min-w-full table-fixed text-center text-gray-500 dark:text-gray-400"
        >
          <thead
            class="text-sm text-gray-700 uppercase font-bold bg-gray-50 dark:bg-gray-600 dark:text-gray-300"
          >
            <tr>
              <th scope="col" class="px-6 py-4 border-r w-15">
                <Dropdown align="left" width="400">
                  <template #trigger>
                    <button
                      type="button"
                      class="w-full flex items-center justify-between rounded-md px-3 py-2 focus:outline-none transition ease-in-out duration-150"
                    >
                      <span class="uppercase">Title</span>
                      <ChevronDoubleDownIcon
                        class="ml-2 h-5 w-5 transition duration-150 ease-in-out group-hover:text-opacity-80"
                      />
                    </button>
                  </template>

                  <template #content>
                    <DropdownItem>
                      <div class="mb-6 w-full">
                        <label
                          for="nameContains"
                          class="block mb-2 text-md text-left font-light text-gray-900 dark:text-gray-300"
                        >
                          Title Contains
                        </label>
                        <input
                          type="text"
                          id="nameContains"
                          class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white"
                        />
                      </div>
                    </DropdownItem>
                  </template>
                </Dropdown>
              </th>
              <th scope="col" class="px-6 py-4 border-r w-20">
                <Dropdown align="left" width="400">
                  <template #trigger>
                    <button
                      type="button"
                      class="w-full flex items-center justify-between rounded-md px-3 py-2 focus:outline-none transition ease-in-out duration-150"
                    >
                      <span class="uppercase">Author</span>
                      <ChevronDoubleDownIcon
                        class="ml-2 h-5 w-5 transition duration-150 ease-in-out group-hover:text-opacity-80"
                      />
                    </button>
                  </template>

                  <template #content>
                    <DropdownItem>
                      <div class="mb-6 w-full">
                        <label
                          for="nameContains"
                          class="block mb-2 text-md text-left font-light text-gray-900 dark:text-gray-300"
                        >
                          Author Name Contains
                        </label>
                        <input
                          type="text"
                          id="nameContains"
                          class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white"
                        />
                      </div>
                    </DropdownItem>
                  </template>
                </Dropdown>
              </th>
              <th scope="col" class="px-6 py-4 border-r w-10">
                <Dropdown align="left" width="400">
                  <template #trigger>
                    <button
                      type="button"
                      class="w-full flex items-center justify-between rounded-md px-3 py-2 focus:outline-none transition ease-in-out duration-150"
                    >
                      <span class="uppercase">Category</span>
                      <ChevronDoubleDownIcon
                        class="ml-2 h-5 w-5 transition duration-150 ease-in-out group-hover:text-opacity-80"
                      />
                    </button>
                  </template>

                  <template #content>
                    <DropdownItem>
                      <div class="mb-6 w-full">
                        <label
                          for="nameContains"
                          class="block mb-2 text-md text-left font-light text-gray-900 dark:text-gray-300"
                        >
                          Category
                        </label>
                        <input
                          type="text"
                          id="nameContains"
                          class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white"
                        />
                      </div>
                    </DropdownItem>
                  </template>
                </Dropdown>
              </th>
              <th scope="col" class="px-6 py-4 border-r">Created At</th>
              <th scope="col" class="px-6 py-4 border-r">Expires At</th>
              <th scope="col" class="px-6 py-4 w-10">Actions</th>
            </tr>
          </thead>
          <tbody>
            <tr
              :class="
                index % 2 === 0
                  ? 'bg-white dark:bg-gray-900'
                  : 'bg-gray-50  dark:bg-gray-800'
              "
              class="border-b dark:border-gray-700"
              v-for="(dataSource, index) in dataSources"
              v-bind:key="index"
            >
              <td
                class="font-medium text-left text-gray-900 px-6 py-4 text-ellipsis overflow-hidden whitespace-nowrap dark:text-white border-r"
              >
                <Link :href="dataSource.source">
                  {{ dataSource.title }}
                </Link>
              </td>
              <td class="text-sm font-light px-6 py-4 break-all border-r">
                {{ dataSource.author }}
              </td>
              <td
                class="text-sm font-light px-6 py-4 whitespace-nowrap border-r"
              >
                {{ $titlecase(dataSource.category) }}
              </td>
              <td
                class="text-sm font-light px-6 py-4 whitespace-nowrap border-r"
              >
                {{ new Date(dataSource.created_at).toDateString() }}
              </td>
              <td
                class="text-sm font-light px-6 py-4 whitespace-nowrap border-r"
              >
                {{ new Date(dataSource.expires_at).toDateString() }}
              </td>
              <td
                class="px-6 py-4 flex justify-center items-center whitespace-nowrap"
              >
                <Link
                  class="text-md text-red-700 hover:text-red-800 dark:text-red-600 dark:hover:text-red-700"
                  :href="
                    route('groupRemoveFromGroup', {
                      id: groupId,
                      dataSourceId: dataSource.id
                    })
                  "
                >
                  <XMarkIcon class="h-5 w-5"
                /></Link>
              </td>
            </tr>
          </tbody>
        </table>
      </div>

      <Pagination
        :meta="{
          from: dataSourceMeta.from,
          to: dataSourceMeta.to,
          total: dataSourceMeta.total,
          current_page: dataSourceMeta.current_page,
          last_page: dataSourceMeta.last_page
        }"
        routeName="libraryIndex"
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
        There are no instances in this group yet.
      </p>
    </div>

    <SharedDialog
      :isOpen="openRemoveFromGroupDialog && isOpen"
      goBackTo="groupShow"
      :goBackToId="groupId"
      @closeDialog="closeModal"
    >
      <template #title>Stop Sharing an Instance with a Group?</template>

      <div class="flex items-center justify-end mt-4 gap-5">
        <Link :href="route('groupShow', groupId)" @click="closeModal">
          <Button
            class="inline-flex justify-center rounded-md border border-transparent bg-blue-100 px-4 py-2 text-sm font-medium text-blue-900 hover:bg-blue-200 focus:outline-none focus-visible:ring-2 focus-visible:ring-blue-500 focus-visible:ring-offset-2"
          >
            Cancel
          </Button>
        </Link>
        <Link
          :href="route('groupShow', groupId)"
          @click="addOrRemoveDataSource"
        >
          <Button
            class="inline-flex justify-center rounded-md border border-transparent text-red-700 hover:text-white border border-red-700 hover:bg-red-800 dark:border-red-500 dark:text-red-500 dark:hover:text-white dark:hover:bg-red-600"
          >
            Yes, remove
          </Button>
        </Link>
      </div>
    </SharedDialog>
  </AuthenticatedLayout>
</template>
