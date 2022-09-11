<script setup>
import {
  ChevronDownIcon,
  ChevronDoubleDownIcon,
  ChevronUpIcon,
  EllipsisVerticalIcon,
  TrashIcon,
  PencilSquareIcon,
  PlusIcon,
  ArrowUpOnSquareIcon
} from '@heroicons/vue/24/outline';
import { usePage } from '@inertiajs/inertia-vue3';
import { ref, computed, onMounted, reactive } from '@vue/runtime-core';

import { useDataSources } from '@/Composables/DataSources';
import { useCollections } from '@/Composables/Collections';
import { useGroups } from '@/Composables/Groups';
import { useNotifications } from '@/Composables/Notifications';

const url = new URL(window.location);
const dataSourceId = url.pathname.split('/')[2];

const categories = [
  { title: 'Article', value: 'article' },
  { title: 'URL Link', value: 'link' },
  { title: 'Video', value: 'video' },
  { title: 'Book', value: 'book' }
];

const selectedCategory = ref(categories[0]);
const selectedCollection = ref({});
const selectedGroup = ref({});

const isOpen = ref(true);
const openCreateDialog = ref(false);
const openPreviewDialog = computed(
  () => usePage().props.value.openPreviewDialog
);
const openAddToCollectionDialog = computed(
  () => usePage().props.value.openAddToCollectionDialog
);
const openShareWithGroupDialog = computed(
  () => usePage().props.value.openShareWithGroupDialog
);
const openDeleteConfirmationDialog = computed(
  () => usePage().props.value.openDeleteConfirmationDialog
);

const form = reactive({
  title: '',
  author: '',
  source: '',
  category: selectedCategory.value.value,
  expires_in: 3
});

const { storeNotification } = useNotifications();

const pushNotification = async (info) => {
  await storeNotification({ ...info });
};

const {
  dataSource,
  dataSources,
  dataSourceMeta,
  errors,
  getDataSources,
  getDataSource,
  storeDataSource,
  updateDataSource,
  destroyDataSource
} = useDataSources();

const createDataSource = async () => {
  await storeDataSource({ ...form });

  if (!!!errors.value) {
    pushNotification({
      type: 'create',
      title: 'Data Source Created',
      body: `Data Source <span class="font-extrabold">${form.title}</span> has been created succesfully.`
    });

    closeModal();
  }
};

const saveDataSource = async () => {
  await updateDataSource(dataSourceId);

  if (!!!errors.value) {
    pushNotification({
      type: 'update',
      title: 'Data Source Updated',
      body: `Data Source <span class="font-extrabold">${dataSource.value.title}</span> has been updated succesfully.`
    });

    closeModal();
  }
};

const deleteDataSource = async () => {
  await destroyDataSource(dataSourceId);

  if (!!!errors.value) {
    pushNotification({
      type: 'delete',
      title: 'Data Source Deleted',
      body: `Data Source <span class="font-extrabold">${dataSource.value.title}</span> has been deleted succesfully.`
    });

    closeModal();
  }
};

const { collections, getCollections, addOrRemoveDataSourceToCollection } =
  useCollections();

const saveCollection = async () => {
  await addOrRemoveDataSourceToCollection(selectedCollection, dataSourceId);

  pushNotification({
    type: 'update',
    title: 'Data Source Assigned to a Collection',
    body: `Data Source <span class="font-extrabold">${dataSource.value.title}</span> has been assigned to <span class="font-extrabold">${selectedCollection.value.title}</span> succesfully.`
  });

  closeModal();
};

const { groups, getGroups, addOrRemoveDataSourceToGroup } = useGroups();

const saveGroup = async () => {
  await addOrRemoveDataSourceToGroup(selectedGroup, dataSourceId);

  pushNotification({
    type: 'update',
    title: 'Data Source Shared with a Group',
    body: `Data Source <span class="font-extrabold">${dataSource.value.title}</span> has been shared with <span class="font-extrabold">${selectedGroup.value.title}</span> succesfully.`
  });

  closeModal();
};

onMounted(() => {
  getDataSources({});

  if (openPreviewDialog.value || openDeleteConfirmationDialog.value) {
    getDataSource(dataSourceId);
    isOpen.value = true;
  } else if (openAddToCollectionDialog.value) {
    getDataSource(dataSourceId);
    getCollections({});
    selectedCollection.value = collections[0];
    isOpen.value = true;
  } else if (openShareWithGroupDialog.value) {
    getDataSource(dataSourceId);
    getGroups({});
    selectedGroup.value = groups[0];
    isOpen.value = true;
  }
});

const resetFormValues = () => {
  form.title = '';
  form.author = '';
  form.source = '';
  form.category = selectedCategory.value.value;
  form.expires_in = 3;
};

const closeModal = () => {
  isOpen.value = false;
  openCreateDialog.value = false;

  resetFormValues();
  getDataSources({});
};

const onSelectionChange = (param) => {
  selectedCategory.value = param;
  form.category = param.value;
};

const onCollectionSelectionChange = (param) => {
  selectedCollection.value = param;
};

const onGroupSelectionChange = (param) => {
  selectedGroup.value = param;
};
</script>
<template>
  <AuthenticatedLayout>
    <Head title="Library" />

    <template #header>Library</template>

    <div class="flex items-center justify-end mb-4">
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
              <td class="px-6 py-4 whitespace-nowrap">
                <Dropdown align="right" width="48">
                  <template #trigger>
                    <span class="inline-flex rounded-md">
                      <button
                        type="button"
                        class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-white bg-transparent dark:bg-gray-700 hover:text-gray-700 focus:outline-none transition ease-in-out duration-150"
                      >
                        <EllipsisVerticalIcon class="h-5 w-5" />
                      </button>
                    </span>
                  </template>

                  <template #content>
                    <DropdownLink
                      :href="route('libraryPreview', dataSource.id)"
                      as="button"
                      class="flex items-center gap-2 text-md"
                    >
                      <PencilSquareIcon class="h-5 w-5" />
                      <span>Edit</span>
                    </DropdownLink>
                    <DropdownLink
                      :href="route('libraryAddToCollection', dataSource.id)"
                      as="button"
                      class="flex items-center gap-2 text-md"
                    >
                      <PlusIcon class="h-5 w-5" />
                      <span>Assign to</span>
                    </DropdownLink>
                    <DropdownLink
                      :href="route('libraryShareWithGroup', dataSource.id)"
                      as="button"
                      class="flex items-center gap-2 text-md"
                    >
                      <ArrowUpOnSquareIcon class="h-5 w-5" />
                      <span>Share with</span>
                    </DropdownLink>
                    <DropdownLink
                      :href="route('libraryDelete', dataSource.id)"
                      as="button"
                      class="flex items-center gap-2 text-md text-red-700 hover:text-red-800 dark:text-red-600 dark:hover:text-red-700"
                    >
                      <TrashIcon class="h-5 w-5" />
                      <span>Delete</span>
                    </DropdownLink>
                  </template>
                </Dropdown>
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
        You currently have no instances of this type. Feel free to create one,
        or two...
      </p>
      <div class="w-full inline-flex justify-end items-center">
        <Button
          type="button"
          class="py-3 px-5 text-base font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800"
          @click="() => (openCreateDialog = true)"
        >
          Create an instance
        </Button>
      </div>
    </div>

    <SharedDialog
      :isOpen="openCreateDialog && isOpen"
      @closeDialog="closeModal"
    >
      <template #title>Add a New Data Source</template>

      <form class="mt-2" @submit.prevent="createDataSource">
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
          <Label for="author" value="Author" />
          <Input
            id="author"
            type="text"
            class="mt-1 block w-full"
            v-model="form.author"
          />
          <InputError
            v-if="!!errors.author"
            class="mt-2"
            :message="errors.author[0]"
          />
        </div>

        <div class="mt-4">
          <Label for="source" value="Source" />
          <Input
            id="source"
            type="url"
            class="mt-1 block w-full"
            v-model="form.source"
          />
          <InputError
            v-if="!!errors.source"
            class="mt-2"
            :message="errors.source[0]"
          />
        </div>

        <div class="mt-4">
          <Label for="category" value="Category" />
          <Select
            :selectedOption="selectedCategory"
            :options="categories"
            @selectionChange="(e) => onSelectionChange(e)"
          ></Select>
        </div>

        <div class="mt-4">
          <Label for="expires_in" value="Expires In Days" />
          <Input
            id="expires_in"
            type="number"
            min="1"
            max="100"
            class="mt-1 block w-full"
            v-model="dataSource.expires_in"
          />
          <InputError
            v-if="!!errors.expires_in"
            class="mt-2"
            :message="errors.expires_in[0]"
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
      @closeDialog="closeModal"
    >
      <template #title>Update Instance</template>

      <form class="mt-2" @submit.prevent="saveDataSource">
        <div>
          <Label for="title" value="Title" />
          <Input
            id="title"
            type="text"
            class="mt-1 block w-full"
            v-model="dataSource.title"
          />
          <InputError
            v-if="!!errors.title"
            class="mt-2"
            :message="errors.title[0]"
          />
        </div>

        <div class="mt-4">
          <Label for="author" value="Author" />
          <Input
            id="author"
            type="text"
            class="mt-1 block w-full"
            v-model="dataSource.author"
          />
          <InputError
            v-if="!!errors.author"
            class="mt-2"
            :message="errors.author[0]"
          />
        </div>

        <div class="mt-4">
          <Label for="source" value="Source" />
          <Input
            id="source"
            type="url"
            class="mt-1 block w-full"
            v-model="dataSource.source"
          />
          <InputError
            v-if="!!errors.source"
            class="mt-2"
            :message="errors.source[0]"
          />
        </div>

        <div class="mt-4">
          <Label for="category" value="Category" />
          <Select
            :selectedOption="selectedCategory"
            :options="categories"
            @selectionChange="(e) => onSelectionChange(e)"
          ></Select>
        </div>

        <div class="mt-4">
          <Label for="expires_in" value="Expires In Days" />
          <Input
            id="expires_in"
            type="number"
            min="1"
            max="100"
            class="mt-1 block w-full"
            v-model="dataSource.expires_in"
          />
          <InputError
            v-if="!!errors.expires_in"
            class="mt-2"
            :message="errors.expires_in[0]"
          />
        </div>

        <div class="flex items-center justify-end mt-4 gap-5">
          <Link :href="route('libraryIndex')" @click="closeModal">
            <Button
              class="inline-flex justify-center rounded-md border border-transparent bg-blue-100 px-4 py-2 text-sm font-medium text-blue-900 hover:bg-blue-200 focus:outline-none focus-visible:ring-2 focus-visible:ring-blue-500 focus-visible:ring-offset-2"
            >
              Cancel
            </Button>
          </Link>
          <Link :href="route('libraryIndex')" @click="saveDataSource">
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
      @closeDialog="closeModal"
    >
      <template #title>Are you sure you want to Delete this Instance?</template>

      <div
        v-if="!!dataSource.id"
        class="flex items-center justify-end mt-4 gap-5"
      >
        <Link :href="route('libraryIndex')" @click="closeModal">
          <Button
            class="inline-flex justify-center rounded-md border border-transparent bg-blue-100 px-4 py-2 text-sm font-medium text-blue-900 hover:bg-blue-200 focus:outline-none focus-visible:ring-2 focus-visible:ring-blue-500 focus-visible:ring-offset-2"
          >
            Cancel
          </Button>
        </Link>
        <Link :href="route('libraryIndex')" @click="deleteDataSource">
          <Button
            class="inline-flex justify-center rounded-md border border-transparent text-red-700 hover:text-white border border-red-700 hover:bg-red-800 dark:border-red-500 dark:text-red-500 dark:hover:text-white dark:hover:bg-red-600"
          >
            Yes, delete
          </Button>
        </Link>
      </div>

      <div v-else>
        <h1
          class="mb-4 text-4xl font-extrabold tracking-tight leading-none text-gray-900 md:text-5xl lg:text-6xl dark:text-white"
        >
          Whoops!
        </h1>
        <p class="text-lg font-normal text-gray-500 dark:text-gray-400">
          Looks like this instance has been deleted!
        </p>
      </div>
    </SharedDialog>

    <SharedDialog
      :isOpen="openAddToCollectionDialog && isOpen"
      @closeDialog="closeModal"
    >
      <template #title>Add Instance to a Collection</template>

      <form class="mt-2" @submit.prevent="saveCollection">
        <div class="mt-4">
          <Select
            :selectedOption="collections[0]"
            :options="collections"
            @selectionChange="(e) => onCollectionSelectionChange(e)"
          ></Select>
        </div>

        <div class="flex items-center justify-end mt-4 gap-5">
          <Link :href="route('libraryIndex')" @click="closeModal">
            <Button
              class="inline-flex justify-center rounded-md border border-transparent bg-blue-100 px-4 py-2 text-sm font-medium text-blue-900 hover:bg-blue-200 focus:outline-none focus-visible:ring-2 focus-visible:ring-blue-500 focus-visible:ring-offset-2"
            >
              Cancel
            </Button>
          </Link>
          <Link :href="route('libraryIndex')" @click="saveCollection">
            <Button
              class="inline-flex justify-center rounded-md border border-transparent bg-blue-100 px-4 py-2 text-sm font-medium text-blue-900 hover:bg-blue-200 focus:outline-none focus-visible:ring-2 focus-visible:ring-blue-500 focus-visible:ring-offset-2"
            >
              Assign
            </Button>
          </Link>
        </div>
      </form>
    </SharedDialog>

    <SharedDialog
      :isOpen="openShareWithGroupDialog && isOpen"
      @closeDialog="closeModal"
    >
      <template #title>Share Instance with a Group</template>

      <form class="mt-2" @submit.prevent="saveGroup">
        <div class="mt-4">
          <Select
            :selectedOption="groups[0]"
            :options="groups"
            @selectionChange="(e) => onGroupSelectionChange(e)"
          ></Select>
        </div>

        <div class="flex items-center justify-end mt-4 gap-5">
          <Link :href="route('libraryIndex')" @click="closeModal">
            <Button
              class="inline-flex justify-center rounded-md border border-transparent bg-blue-100 px-4 py-2 text-sm font-medium text-blue-900 hover:bg-blue-200 focus:outline-none focus-visible:ring-2 focus-visible:ring-blue-500 focus-visible:ring-offset-2"
            >
              Cancel
            </Button>
          </Link>
          <Link :href="route('libraryIndex')" @click="saveGroup">
            <Button
              class="inline-flex justify-center rounded-md border border-transparent bg-blue-100 px-4 py-2 text-sm font-medium text-blue-900 hover:bg-blue-200 focus:outline-none focus-visible:ring-2 focus-visible:ring-blue-500 focus-visible:ring-offset-2"
            >
              Share
            </Button>
          </Link>
        </div>
      </form>
    </SharedDialog>
  </AuthenticatedLayout>
</template>
<style scoped>
th,
td {
  max-width: 200px;
}
</style>
