<script setup>
import { Popover, PopoverButton, PopoverPanel } from '@headlessui/vue';
import {
  ChevronDownIcon,
  ChevronDoubleDownIcon,
  ChevronUpIcon,
  EllipsisVerticalIcon,
  TrashIcon,
  PencilSquareIcon,
  PlusIcon,
  XMarkIcon
} from '@heroicons/vue/24/solid';
import { usePage } from '@inertiajs/inertia-vue3';
import { computed, onMounted, ref } from '@vue/runtime-core';

import { useDataSources } from '@/Composables/DataSources';
import { useGroups } from '@/Composables/Groups';

const url = new URL(window.location);
const groupId = url.pathname.split('/')[2];
const dataSourceId = url.pathname.split('/')[4];

const { group, getGroup, addOrRemoveDataSourceToGroup } = useGroups();

const saveGroup = async () => {
  await addOrRemoveDataSourceToGroup(group, dataSourceId, true);

  closeModal();
};

const {
  dataSource,
  dataSources,
  dataSourceMeta,
  errors,
  getDataSources,
  storeDataSource,
  updateDataSource,
  destroyDataSource
} = useDataSources();

const createDataSource = async () => {
  await storeDataSource({ ...form });
  getDataSources();

  if (!!!errors.value) {
    closeModal();
  }
};

const saveDataSource = async () => {
  await updateDataSource(dataSource.value.id);
};

const deleteDataSource = async (id) => {
  await destroyDataSource(id);
};

onMounted(() => {
  getDataSources({ groupId });

  if (openRemoveFromGroupDialog) getGroup(groupId);
});

const openRemoveFromGroupDialog = computed(
  () => usePage().props.value.openRemoveFromGroupDialog
);

const isOpen = ref(true);
const closeModal = () => {
  isOpen.value = false;
};
</script>

<template>
  <AuthenticatedLayout>
    <Head title="Preview Group" />

    <template #header>Preview Group</template>

    <div
      v-if="dataSourceMeta.total > 0"
      class="overflow-x-auto sm:-mx-6 lg:-mx-8"
    >
      <div class="py-2 inline-block min-w-full sm:px-6 lg:px-8">
        <table
          class="min-w-full table-fixed text-center text-gray-500 dark:text-gray-400"
        >
          <thead
            class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-600 dark:text-gray-300"
          >
            <tr>
              <th scope="col" class="px-6 py-4 border-r w-15">
                <Popover v-slot="{ open }" class="relative">
                  <PopoverButton
                    :class="open ? '' : 'text-opacity-90'"
                    class="group w-full inline-flex items-center justify-between rounded-md px-3 py-2 font-medium hover:text-opacity-100 focus:outline-none focus-visible:ring-2 focus-visible:ring-white focus-visible:ring-opacity-75"
                  >
                    <span class="uppercase">Title</span>
                    <ChevronDoubleDownIcon
                      :class="open ? 'rotate-180 transform' : ''"
                      class="ml-2 h-5 w-5 transition duration-150 ease-in-out group-hover:text-opacity-80"
                      aria-hidden="true"
                    />
                  </PopoverButton>

                  <transition
                    enter-active-class="transition duration-200 ease-out"
                    enter-from-class="translate-y-1 opacity-0"
                    enter-to-class="translate-y-0 opacity-100"
                    leave-active-class="transition duration-150 ease-in"
                    leave-from-class="translate-y-0 opacity-100"
                    leave-to-class="translate-y-1 opacity-0"
                  >
                    <PopoverPanel
                      class="absolute z-1 w-full max-w-sm transform px-4 sm:px-0"
                    >
                      <div
                        class="overflow-hidden rounded-lg ring-1 ring-black ring-opacity-5"
                      >
                        <div class="border bg-white p-4">
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
                        </div>
                      </div>
                    </PopoverPanel>
                  </transition>
                </Popover>
              </th>
              <th scope="col" class="font-medium px-6 py-4 border-r w-20">
                <Popover v-slot="{ open }" class="relative">
                  <PopoverButton
                    :class="open ? '' : 'text-opacity-90'"
                    class="group w-full inline-flex items-center justify-between rounded-md px-3 py-2 font-medium hover:text-opacity-100 focus:outline-none focus-visible:ring-2 focus-visible:ring-white focus-visible:ring-opacity-75"
                  >
                    <span class="uppercase">Author</span>
                    <ChevronDoubleDownIcon
                      :class="open ? 'rotate-180 transform' : ''"
                      class="ml-2 h-5 w-5 transition duration-150 ease-in-out group-hover:text-opacity-80"
                      aria-hidden="true"
                    />
                  </PopoverButton>

                  <transition
                    enter-active-class="transition duration-200 ease-out"
                    enter-from-class="translate-y-1 opacity-0"
                    enter-to-class="translate-y-0 opacity-100"
                    leave-active-class="transition duration-150 ease-in"
                    leave-from-class="translate-y-0 opacity-100"
                    leave-to-class="translate-y-1 opacity-0"
                  >
                    <PopoverPanel
                      class="absolute z-1 w-full max-w-sm transform px-4 sm:px-0"
                    >
                      <div
                        class="overflow-hidden rounded-lg ring-1 ring-black ring-opacity-5"
                      >
                        <div class="border bg-white p-4">
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
                        </div>
                      </div>
                    </PopoverPanel>
                  </transition>
                </Popover>
              </th>
              <th scope="col" class="font-medium px-6 py-4 border-r w-10">
                <Popover v-slot="{ open }" class="relative">
                  <PopoverButton
                    :class="open ? '' : 'text-opacity-90'"
                    class="group w-full inline-flex items-center justify-between rounded-md px-3 py-2 font-medium hover:text-opacity-100 focus:outline-none focus-visible:ring-2 focus-visible:ring-white focus-visible:ring-opacity-75"
                  >
                    <span class="uppercase">Category</span>
                    <ChevronDoubleDownIcon
                      :class="open ? 'rotate-180 transform' : ''"
                      class="ml-2 h-5 w-5 transition duration-150 ease-in-out group-hover:text-opacity-80"
                      aria-hidden="true"
                    />
                  </PopoverButton>

                  <transition
                    enter-active-class="transition duration-200 ease-out"
                    enter-from-class="translate-y-1 opacity-0"
                    enter-to-class="translate-y-0 opacity-100"
                    leave-active-class="transition duration-150 ease-in"
                    leave-from-class="translate-y-0 opacity-100"
                    leave-to-class="translate-y-1 opacity-0"
                  >
                    <PopoverPanel
                      class="absolute z-1 w-full max-w-sm transform px-4 sm:px-0"
                    >
                      <div
                        class="overflow-hidden rounded-lg ring-1 ring-black ring-opacity-5"
                      >
                        <div class="border bg-white p-4">
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
                        </div>
                      </div>
                    </PopoverPanel>
                  </transition>
                </Popover>
              </th>
              <th scope="col" class="font-medium px-6 py-4 border-r">
                Created At
              </th>
              <th scope="col" class="font-medium px-6 py-4 border-r">
                Expires At
              </th>
              <th scope="col" class="font-medium px-6 py-4 w-10">Actions</th>
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
              v-bind:key="dataSource.id"
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
              <td class="px-6 py-4 flex justify-center whitespace-nowrap">
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
        <Link :href="route('groupShow', groupId)" @click="saveGroup">
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
