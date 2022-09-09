<script setup>
import { useForm, usePage } from '@inertiajs/inertia-vue3';
import { computed, ref } from '@vue/runtime-core';

const user = computed(() => usePage().props.value.auth.user);

const form = useForm({
  id: user.value.id,
  username: user.value.username,
  first_name: user.value.first_name,
  last_name: user.value.last_name,
  email: user.value.email,
  location: user.value.location,
  occupation: user.value.occupation,
  academic_status: user.value.academic_status,
  description: user.value.description
});

const submit = () => {
  form.patch(route('profileUpdate'));
};

const academicStatuses = [
  { title: 'Researcher', value: 'researcher' },
  { title: 'Student', value: 'student' },
  { title: 'Bachelor', value: 'bachelor' },
  { title: 'Master', value: 'master' },
  { title: 'Doctor', value: 'doctoral' },
  { title: 'PHD', value: 'phd' },
  { title: 'Post Graduate', value: 'postgraduate' }
];

const selectedAcademicStatus = ref(
  academicStatuses.filter(
    (status) => status.value === user.value.academic_status
  )[0]
);

const onSelectionChange = (param) => {
  selectedAcademicStatus.value = param;
  form.academic_status = param.value;
};
</script>
<template>
  <AuthenticatedLayout>
    <Head title="Profile" />

    <template #header>
      <h2
        class="font-semibold text-xl text-gray-800 dark:text-white leading-tight"
      >
        Profile
      </h2>
    </template>

    <div class="mx-auto mb-4">
      <div class="flex align-center justify-center gap-10">
        <h3
          class="flex flex-col text-xl text-center font-semibold text-gray-900 dark:text-white"
        >
          {{ user.data_sources_count }}
          <span class="text-m font-medium text-gray-500 dark:text-gray-100">
            Data Sources
          </span>
        </h3>
        <h3
          class="flex flex-col text-xl text-center font-semibold text-gray-900 dark:text-white"
        >
          {{ user.collections_count }}
          <span class="text-m font-medium text-gray-500 dark:text-gray-100">
            Collections
          </span>
        </h3>
        <h3
          class="flex flex-col text-xl text-center font-semibold text-gray-900 dark:text-white"
        >
          {{ user.groups_count }}
          <span class="text-m font-medium text-gray-500 dark:text-gray-100">
            Groups
          </span>
        </h3>
      </div>
    </div>

    <form @submit.prevent="submit">
      <div class="flex flex-col gap-5">
        <h2
          class="mt-4 font-bold uppercase text-gray-900 text-3xl md:text-3xl dark:text-white"
        >
          User Information
        </h2>

        <div class="flex flex-row gap-5">
          <div class="w-full">
            <Label for="email" value="Email" />
            <Input
              type="email"
              class="mt-1 block w-full"
              v-model="form.email"
            />
            <InputError class="mt-2" :message="form.errors.email" />
          </div>

          <div class="w-full">
            <Label for="first_name" value="First Name" />
            <Input
              type="text"
              class="mt-1 block w-full"
              v-model="form.first_name"
            />
            <InputError class="mt-2" :message="form.errors.first_name" />
          </div>
        </div>

        <div class="flex flex-row gap-5">
          <div class="w-full">
            <Label for="username" value="Username" />
            <Input
              type="text"
              class="mt-1 block w-full"
              v-model="form.username"
            />
            <InputError class="mt-2" :message="form.errors.username" />
          </div>

          <div class="w-full">
            <Label for="last_name" value="Last Name" />
            <Input
              type="text"
              class="mt-1 block w-full"
              v-model="form.last_name"
            />
            <InputError class="mt-2" :message="form.errors.last_name" />
          </div>
        </div>
      </div>

      <div class="flex flex-col gap-5 mt-8">
        <h2
          class="font-bold uppercase text-gray-900 text-3xl md:text-3xl dark:text-white"
        >
          Residential Information
        </h2>

        <div class="flex gap-5">
          <div class="w-full">
            <Label for="location" value="Location" />
            <Input
              type="text"
              class="mt-1 block w-full"
              v-model="form.location"
            />
            <InputError class="mt-2" :message="form.errors.location" />
          </div>

          <div class="w-full">
            <Label for="occupation" value="Occupation" />
            <Input
              type="text"
              class="mt-1 block w-full"
              v-model="form.occupation"
            />
            <InputError class="mt-2" :message="form.errors.occupation" />
          </div>

          <div class="w-full">
            <Label for="academic_status" value="Academic Status" />
            <Select
              :selectedOption="selectedAcademicStatus"
              :options="academicStatuses"
              @selectionChange="(e) => onSelectionChange(e)"
            ></Select>
            <InputError class="mt-2" :message="form.errors.academic_status" />
          </div>
        </div>
      </div>

      <div class="mt-4 mb-6">
        <Label for="description" value="About Me" />
        <textarea
          v-model="form.description"
          rows="5"
          class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
          placeholder="About you..."
        ></textarea>
        <InputError class="mt-2" :message="form.errors.description" />
      </div>

      <div class="w-full inline-flex justify-end items-center">
        <Button class="mt-4">Save Changes</Button>
      </div>
    </form>
  </AuthenticatedLayout>
</template>
