<template>
  <AuthenticatedLayout>
    <Head title="Groups" />

    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">Groups</h2>
    </template>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
          <div class="p-6 bg-white border-b border-gray-200">
            <table
              class="w-full table-auto border border-separate border-spacing-2"
            >
              <thead>
                <tr>
                  <th>Title</th>
                  <th>Data Sources Count</th>
                  <th>Created At</th>
                </tr>
              </thead>
              <tbody>
                <tr
                  v-for="group in $page.props.data.data"
                  v-bind:key="group.id"
                >
                  <td class="text-center">
                    <Link :href="route('groupsShow', group.id)">
                      {{ group.title }}
                    </Link>
                  </td>
                  <td class="text-center">
                    {{ group.data_sources_count }}
                  </td>
                  <td class="text-center">
                    {{ new Date(group.created_at).toDateString() }}
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>
