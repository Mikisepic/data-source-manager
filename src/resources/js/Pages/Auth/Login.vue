<script setup>
import { useForm } from '@inertiajs/inertia-vue3';

defineProps({
  canResetPassword: Boolean,
  status: String
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

    <div v-if="status" class="mb-4 font-medium text-sm text-green-600">
      {{ status }}
    </div>

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
          class="ml-4"
          :class="{ 'opacity-25': form.processing }"
          :disabled="form.processing"
        >
          Log in
        </Button>
      </div>
    </form>
  </GuestLayout>
</template>
