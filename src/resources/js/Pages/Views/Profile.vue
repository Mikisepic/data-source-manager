<script setup>
import { useForm, usePage } from '@inertiajs/inertia-vue3';
import { computed, ref } from '@vue/runtime-core';

const user = computed(() => usePage().props.value.auth.user);

const form = useForm({
  user_id: user.value.id,
  username: user.value.username,
  first_name: user.value.first_name,
  last_name: user.value.last_name,
  location: user.value.location,
  occupation: user.value.occupation,
  academic_status: user.value.academic_status,
  description: user.value.description
});

const submit = () => {
  form.post(route('profileUpdate'));
};

const academicStatuses = [
  { name: 'Researcher', value: 'researcher' },
  { name: 'Student', value: 'student' },
  { name: 'Bachelor', value: 'bachelor' },
  { name: 'Master', value: 'master' },
  { name: 'Doctor', value: 'doctor' },
  { name: 'PHD', value: 'phd' },
  { name: 'Post Graduate', value: 'postgraduate' }
];

const selectedAcademicStatus = ref(
  academicStatuses.filter(
    (status) => status.value === user.value.academic_status
  )[0].name
);

const onSelectionChange = (param) => {
  selectedAcademicStatus.value = param.name;
  form.academic_status = param.value;
};
</script>
<template>
  <AuthenticatedLayout>
    <Head title="Profile" />

    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">Profile</h2>
    </template>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
          <div class="p-6 bg-white border-b border-gray-200">
            {{ $page.props.data }}

            <form @submit.prevent="submit">
              <div>
                <Label for="username" value="Username" />
                <Input
                  type="text"
                  class="mt-1 block w-full"
                  v-model="form.username"
                />
                <InputError class="mt-2" :message="form.errors.username" />
              </div>

              <div class="mt-4">
                <Label for="first_name" value="First Name" />
                <Input
                  type="text"
                  class="mt-1 block w-full"
                  v-model="form.first_name"
                />
                <InputError class="mt-2" :message="form.errors.first_name" />
              </div>

              <div class="mt-4">
                <Label for="last_name" value="Last Name" />
                <Input
                  type="text"
                  class="mt-1 block w-full"
                  v-model="form.last_name"
                />
                <InputError class="mt-2" :message="form.errors.last_name" />
              </div>

              <div class="mt-4">
                <Label for="location" value="Location" />
                <Input
                  type="text"
                  class="mt-1 block w-full"
                  v-model="form.location"
                />
                <InputError class="mt-2" :message="form.errors.location" />
              </div>

              <div class="mt-4">
                <Label for="occupation" value="Occupation" />
                <Input
                  type="text"
                  class="mt-1 block w-full"
                  v-model="form.occupation"
                />
                <InputError class="mt-2" :message="form.errors.occupation" />
              </div>

              <div class="mt-4">
                <Label for="academic_status" value="Academic Status" />
                <Select
                  :modelValue="form.academic_status"
                  :placeholder="selectedAcademicStatus"
                  :options="academicStatuses"
                  @selectionChange="(e) => onSelectionChange(e)"
                ></Select>
                <InputError
                  class="mt-2"
                  :message="form.errors.academic_status"
                />
              </div>

              <div class="mt-4">
                <Label for="description" value="About Me" />
                <Input
                  type="text"
                  class="mt-1 block w-full"
                  v-model="form.description"
                />
                <InputError class="mt-2" :message="form.errors.description" />
              </div>

              <div class="flex items-center justify-end mt-4">
                <Button
                  class="ml-4"
                  :class="{ 'opacity-25': true }"
                  :disabled="true"
                >
                  Save Changes
                </Button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>
