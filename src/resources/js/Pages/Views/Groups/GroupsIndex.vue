<script setup>
import { useGroups } from '@/Composables/Groups';
import { onMounted } from '@vue/runtime-core';

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
  </AuthenticatedLayout>
</template>
