<script setup>
import {
  ListBulletIcon,
  FolderOpenIcon,
  Cog8ToothIcon,
  UserGroupIcon,
  ArrowTopRightOnSquareIcon
} from '@heroicons/vue/24/outline';
</script>

<template>
  <AuthenticatedLayout>
    <Head title="Dashboard" />

    <template #header> Dashboard </template>

    <div class="max-w-7xl mx-auto pt-6 pb-4 sm:px-6 lg:px-8">
      <div class="lg:text-center">
        <h2 class="text-xl text-indigo-600 dark:text-indigo-400 font-semibold">
          Welcome to MAGicle!
        </h2>
        <p
          class="mt-2 text-3xl font-bold tracking-tight text-gray-900 dark:text-white"
        >
          All your data sources in a single place
        </p>
      </div>

      <div class="mt-10">
        <dl
          class="space-y-10 md:space-y-0 md:grid md:grid-cols-2 md:gap-x-8 md:gap-y-10"
        >
          <div class="relative">
            <dt>
              <div
                class="absolute flex items-center justify-center h-12 w-12 rounded-md bg-indigo-500 text-white"
              >
                <ListBulletIcon class="w-7 h-7" />
              </div>
              <p
                class="ml-16 text-lg leading-6 font-medium text-gray-900 dark:text-white"
              >
                Add Data Sources
              </p>
            </dt>
            <dd class="mt-2 ml-16 text-base text-gray-500 dark:text-gray-400">
              Not sure where to start? The main purpose of "MAGicle" is to help
              you classify data sources. All of these will be stored in your own
              <Link
                :href="route('libraryIndex')"
                class="inline-flex items-center font-medium text-blue-600 dark:text-blue-500 hover:underline"
              >
                Library
                <ArrowTopRightOnSquareIcon class="w-5 h-5" /> </Link
              >.
            </dd>
          </div>

          <div class="relative">
            <dt>
              <div
                class="absolute flex items-center justify-center h-12 w-12 rounded-md bg-indigo-500 text-white"
              >
                <FolderOpenIcon class="w-7 h-7" />
              </div>
              <p
                class="ml-16 text-lg leading-6 font-medium text-gray-900 dark:text-white"
              >
                Classify items in Collections
              </p>
            </dt>
            <dd class="mt-2 ml-16 text-base text-gray-500 dark:text-gray-400">
              Need more organization with your existing data sources? We have
              got you covered, create a collection and classify instances by
              topic, e.g. Fitness. Checkout
              <Link
                :href="route('collectionIndex')"
                class="inline-flex items-center font-medium text-blue-600 dark:text-blue-500 hover:underline"
              >
                Collections
                <ArrowTopRightOnSquareIcon class="w-5 h-5" />
              </Link>
              for more details.
            </dd>
          </div>

          <div class="relative">
            <dt>
              <div
                class="absolute flex items-center justify-center h-12 w-12 rounded-md bg-indigo-500 text-white"
              >
                <UserGroupIcon class="w-7 h-7" />
              </div>
              <p
                class="ml-16 text-lg leading-6 font-medium text-gray-900 dark:text-white"
              >
                Share Data Sources with your colleagues
              </p>
            </dt>
            <dd class="mt-2 ml-16 text-base text-gray-500 dark:text-gray-400">
              Found a useful article and want to share it with your colleagues?
              Here you are able to either create or join any group to
              collaborate with your peers on the next big project. Join one or
              start your own group
              <Link
                :href="route('groupIndex')"
                class="inline-flex items-center font-medium text-blue-600 dark:text-blue-500 hover:underline"
              >
                here
                <ArrowTopRightOnSquareIcon class="w-5 h-5" /> </Link
              >.
            </dd>
          </div>

          <div class="relative">
            <dt>
              <div
                class="absolute flex items-center justify-center h-12 w-12 rounded-md bg-indigo-500 text-white"
              >
                <Cog8ToothIcon class="w-7 h-7" />
              </div>
              <p
                class="ml-16 text-lg leading-6 font-medium text-gray-900 dark:text-white"
              >
                Profile customization at its finest
              </p>
            </dt>
            <dd class="mt-2 ml-16 text-base text-gray-500 dark:text-gray-400">
              Some of your personal details are not correct, or interested in
              modifying some of the system settings? Feel free to do so in
              <Link
                :href="route('profileShow')"
                class="inline-flex items-center font-medium text-blue-600 dark:text-blue-500 hover:underline"
              >
                Profile
                <ArrowTopRightOnSquareIcon class="w-5 h-5" />
              </Link>
              and
              <Link
                :href="route('settings')"
                class="inline-flex items-center font-medium text-blue-600 dark:text-blue-500 hover:underline"
              >
                Settings
                <ArrowTopRightOnSquareIcon class="w-5 h-5" />
              </Link>
              pages.
            </dd>
          </div>
        </dl>
      </div>
    </div>
  </AuthenticatedLayout>
</template>
