<script setup>
import { useForm } from '@inertiajs/inertia-vue3';

defineProps({
  canResetPassword: Boolean
});

const form = useForm({
  email: '',
  password: '',
  remember: false
});

const submit = () => {
  form.post(route('login'), {
    onFinish: () => form.reset('password')
  });
};
</script>

<template>
  <GuestLayout>
    <Head title="Log in" />

    <h1
      class="mb-4 text-center text-4xl font-bold tracking-tight leading-none text-gray-900 dark:text-white"
    >
      Welcome Back!
    </h1>

    <form @submit.prevent="submit">
      <div>
        <Label for="email" value="Email" />
        <Input
          id="email"
          type="email"
          class="mt-1 block w-full"
          v-model="form.email"
          autocomplete="username"
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

      <div class="block mt-4">
        <label class="flex items-center">
          <Checkbox name="remember" v-model:checked="form.remember" />
          <span
            class="ml-2 text-sm focus:outline-none font-medium text-gray-900 dark:text-gray-300"
          >
            Remember me
          </span>
        </label>
      </div>

      <div class="flex items-center justify-end mt-4">
        <Link
          :href="route('register')"
          class="underline text-sm text-gray-600 hover:text-gray-900 dark:text-gray-300 dark:hover:text-gray-400"
        >
          Don't have an account yet?
        </Link>

        <Button
          class="ml-4 text-blue-700 hover:text-white border-blue-700 hover:bg-blue-800 rounded-lg text-sm px-5 py-2.5 dark:border-blue-500 dark:text-blue-500 dark:hover:text-white dark:hover:bg-blue-600"
          :class="{ 'opacity-25': form.processing }"
          :disabled="form.processing"
        >
          Log in
        </Button>
      </div>
    </form>
  </GuestLayout>
</template>
