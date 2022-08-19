<script setup>
import { useForm, usePage } from '@inertiajs/inertia-vue3';
import { computed } from '@vue/runtime-core';

const user = computed(() => usePage().props.value.auth.user);

const form = useForm({
  user_id: user.value.id,
  title: '',
  source: '',
  category: 'article',
  expires_at: new Date(Date.now())
});

const submit = () => {
  form.post(route('libraryPost'));
};
</script>

<template>
  <AuthenticatedLayout>
    <Head title="Library" />

    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">Library</h2>
    </template>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
          <div class="p-6 bg-white border-b border-gray-200">
            {{ $page.props.data.data[0] }}

            <form @submit.prevent="submit">
              <div>
                <Label for="title" value="Title" />
                <Input
                  id="name"
                  type="text"
                  class="mt-1 block w-full"
                  v-model="form.title"
                  required
                  autofocus
                />
                <InputError class="mt-2" :message="form.errors.title" />
              </div>

              <div class="mt-4">
                <Label for="source" value="Source" />
                <Input
                  id="source"
                  type="url"
                  class="mt-1 block w-full"
                  v-model="form.source"
                  required
                />
                <InputError class="mt-2" :message="form.errors.source" />
              </div>

              <div class="mt-4">
                <Label for="category" value="Category" />
                <Input
                  id="category"
                  type="text"
                  class="mt-1 block w-full"
                  v-model="form.category"
                  required
                />
                <InputError class="mt-2" :message="form.errors.category" />
              </div>

              <div class="mt-4">
                <Label for="expires_at" value="Expires At" />
                <Input
                  id="expires_at"
                  type="date"
                  class="mt-1 block w-full"
                  v-model="form.expires_at"
                  required
                />
                <InputError class="mt-2" :message="form.errors.expires_at" />
              </div>

              <div class="flex items-center justify-end mt-4">
                <Button
                  class="ml-4"
                  :class="{ 'opacity-25': form.processing }"
                  :disabled="form.processing"
                >
                  Register
                </Button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>
