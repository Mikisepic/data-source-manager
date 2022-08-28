<template>
  <AuthenticatedLayout>
    <Head title="Library Show" />

    <template #header>
      <h2
        class="font-semibold text-xl text-gray-800 dark:text-white leading-tight"
      >
        Library Show
      </h2>
    </template>

    {{ $page.props.data }}
  </AuthenticatedLayout>
</template>
