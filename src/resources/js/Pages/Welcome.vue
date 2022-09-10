<script setup>
import { ArrowRightIcon } from '@heroicons/vue/24/outline';

defineProps({
  canLogin: Boolean,
  canRegister: Boolean
});
</script>

<template>
  <div>
    <Head title="Welcome" />

    <div
      class="relative min-h-[90vh] flex flex-col justify-center bg-gray-100 dark:bg-gray-900 sm:items-center sm:pt-0"
    >
      <div
        class="container flex md:flex-row flex-col-reverse bg-white dark:bg-gray-800 overflow-hidden shadow sm:rounded-lg"
      >
        <div>
          <img
            class="object-cover w-full h-full"
            src="/storage/img/illustration.jpg"
          />
        </div>

        <div class="bg-white shadow-md dark:bg-gray-800 dark:border-gray-700">
          <Link href="/">
            <img class="p-5 dark:bg-gray-700" src="/storage/img/logo.png" />
          </Link>

          <div class="p-5">
            <h5
              class="mb-2 text-4xl font-bold tracking-tight text-gray-900 dark:text-white"
            >
              Welcome to MAGicle
            </h5>

            <p class="mb-5 font-normal text-gray-700 dark:text-gray-400">
              A perfect place to save your articles.
            </p>

            <div class="w-full inline-flex justify-end items-center">
              <Link
                :href="
                  $page.props.auth.user ? route('dashboard') : route('login')
                "
                class="text-sm text-gray-700 dark:text-white"
              >
                <Button
                  class="items-center py-2 px-3 text-md font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 dark:bg-blue-600 dark:hover:bg-blue-700"
                >
                  {{ $page.props.auth.user ? 'Dashboard' : 'Login' }}
                  <ArrowRightIcon class="ml-2 -mr-1 w-5 h-5" />
                </Button>
              </Link>
            </div>
          </div>
        </div>
      </div>
    </div>

    <footer
      class="p-4 bg-white md:flex md:items-center md:justify-between md:p-6 dark:bg-gray-800"
    >
      <span class="text-sm text-gray-500 sm:text-center dark:text-gray-400">
        © {{ new Date().getFullYear() }}
        <a href="#" class="hover:underline">MAGicle™</a>. All Rights Reserved.
      </span>
      <ul
        class="flex flex-wrap items-center mt-3 text-sm text-gray-500 dark:text-gray-400 sm:mt-0"
      >
        <li>
          <a
            target="_blank"
            href="https://git.mif.vu.lt/mipu7431/data-source-manager/-/blob/master/README.md"
            class="mr-4 hover:underline md:mr-6"
          >
            About
          </a>
        </li>
        <li>
          <a
            target="_blank"
            href="https://git.mif.vu.lt/mipu7431/data-source-manager/-/blob/master/CONTRIBUTING.md"
            class="mr-4 hover:underline md:mr-6"
          >
            Contributing
          </a>
        </li>
        <li>
          <a
            target="_blank"
            href="mailto:mikas.pupeikis@mif.stud.vu.lt"
            class="hover:underline"
          >
            Contact
          </a>
        </li>
      </ul>
    </footer>
  </div>
</template>
