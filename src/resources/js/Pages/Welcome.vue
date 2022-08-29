<script setup>
defineProps({
  canLogin: Boolean,
  canRegister: Boolean
});
</script>

<template>
  <div>
    <Head title="Welcome" />

    <div
      class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center sm:pt-0"
    >
      <div v-if="canLogin" class="block fixed top-0 right-0 px-6 py-4">
        <Link
          v-if="$page.props.auth.user"
          :href="route('dashboard')"
          class="text-sm text-gray-700 dark:text-white underline"
        >
          Dashboard
        </Link>

        <template v-else>
          <Link
            :href="route('login')"
            class="text-sm text-gray-700 dark:text-white underline"
          >
            Log in
          </Link>

          <Link
            v-if="canRegister"
            :href="route('register')"
            class="ml-4 text-sm text-gray-700 dark:text-white underline"
          >
            Register
          </Link>
        </template>
      </div>

      <div class="container">
        <div
          class="mt-8 bg-white dark:bg-gray-800 overflow-hidden shadow sm:rounded-lg"
        >
          <div class="grid grid-cols-1 md:grid-cols-2">
            <div>
              <img src="/storage/img/illustration.jpg" />
            </div>

            <div
              class="p-6 border-t border-gray-200 dark:border-gray-700 md:border-t-0 md:border-l flex justify-center items-center"
            >
              <img class="w-auto text-gray-700" src="/storage/img/logo.png" />
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
