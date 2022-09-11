<script setup>
import { useForm } from '@inertiajs/inertia-vue3';

const form = useForm({
  username: '',
  first_name: '',
  last_name: '',
  email: '',
  password: '',
  password_confirmation: '',
  terms: false
});

const submit = () => {
  form.post(route('register'), {
    onFinish: () => form.reset('password', 'password_confirmation')
  });
};
</script>

<template>
  <GuestLayout>
    <Head title="Register" />

    <h1
      class="mb-4 text-center text-4xl font-bold tracking-tight leading-none text-gray-900 dark:text-white"
    >
      Create an Account
    </h1>

    <form @submit.prevent="submit">
      <div>
        <Label for="username" value="Username" />
        <Input
          id="username"
          type="text"
          class="mt-1 block w-full"
          v-model="form.username"
        />
        <InputError class="mt-2" :message="form.errors.username" />
      </div>

      <div class="mt-4">
        <Label for="first_name" value="First Name" />
        <Input
          id="first_name"
          type="text"
          class="mt-1 block w-full"
          v-model="form.first_name"
        />
        <InputError class="mt-2" :message="form.errors.first_name" />
      </div>

      <div class="mt-4">
        <Label for="last_name" value="Last Name" />
        <Input
          id="last_name"
          type="text"
          class="mt-1 block w-full"
          v-model="form.last_name"
        />
        <InputError class="mt-2" :message="form.errors.last_name" />
      </div>

      <div class="mt-4">
        <Label for="email" value="Email" />
        <Input
          id="email"
          type="email"
          class="mt-1 block w-full"
          v-model="form.email"
        />
        <InputError class="mt-2" :message="form.errors.email" />
      </div>

      <div class="mt-4">
        <Label for="password" value="Password" />
        <Input
          id="password"
          type="password"
          class="mt-1 block w-full"
          v-model="form.password"
        />
        <InputError class="mt-2" :message="form.errors.password" />
      </div>

      <div class="mt-4">
        <Label for="password_confirmation" value="Confirm Password" />
        <Input
          id="password_confirmation"
          type="password"
          class="mt-1 block w-full"
          v-model="form.password_confirmation"
        />
        <InputError class="mt-2" :message="form.errors.password_confirmation" />
      </div>

      <div class="flex items-center justify-end mt-4">
        <Link
          :href="route('login')"
          class="underline text-sm text-gray-600 hover:text-gray-900 dark:text-gray-300 dark:hover:text-gray-400"
        >
          Already registered?
        </Link>

        <Button
          class="ml-4 text-blue-700 hover:text-white border-blue-700 hover:bg-blue-800 rounded-lg text-sm px-5 py-2.5 dark:border-blue-500 dark:text-blue-500 dark:hover:text-white dark:hover:bg-blue-600"
          :class="{ 'opacity-25': form.processing }"
          :disabled="form.processing"
        >
          Register
        </Button>
      </div>
    </form>
  </GuestLayout>
</template>
