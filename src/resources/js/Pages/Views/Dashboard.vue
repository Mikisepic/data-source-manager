<script setup>
import {
  ListBulletIcon,
  FolderOpenIcon,
  Cog8ToothIcon,
  UserGroupIcon
} from '@heroicons/vue/24/outline';
</script>

<template>
  <AuthenticatedLayout>
    <Head title="Dashboard" />

    <template #header>
      <h2
        class="font-semibold text-xl text-gray-800 dark:text-white leading-tight"
      >
        Dashboard
      </h2>
    </template>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="lg:text-center">
        <h2 class="text-xl text-indigo-600 dark:text-indigo-400 font-semibold">
          Welcome to MAGicle!
        </h2>
        <p
          class="mt-2 text-3xl font-bold tracking-tight text-gray-900 dark:text-white"
        >
          All your data sources in a single place
        </p>
        <p
          class="mt-4 max-w-2xl text-xl text-gray-700 dark:text-gray-400 lg:mx-auto"
        >
          Lorem ipsum dolor sit amet consect adipisicing elit. Possimus magnam
          voluptatum cupiditate veritatis in accusamus quisquam.
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
              <p class="ml-16 text-lg leading-6 font-medium text-gray-900">
                Add Data Sources
              </p>
            </dt>
            <dd class="mt-2 ml-16 text-base text-gray-500">
              Lorem ipsum, dolor sit amet consectetur adipisicing elit. Maiores
              impedit perferendis suscipit eaque, iste dolor cupiditate
              blanditiis ratione.
            </dd>
          </div>

          <div class="relative">
            <dt>
              <div
                class="absolute flex items-center justify-center h-12 w-12 rounded-md bg-indigo-500 text-white"
              >
                <FolderOpenIcon class="w-7 h-7" />
              </div>
              <p class="ml-16 text-lg leading-6 font-medium text-gray-900">
                Classify items in Collections
              </p>
            </dt>
            <dd class="mt-2 ml-16 text-base text-gray-500">
              Lorem ipsum, dolor sit amet consectetur adipisicing elit. Maiores
              impedit perferendis suscipit eaque, iste dolor cupiditate
              blanditiis ratione.
            </dd>
          </div>

          <div class="relative">
            <dt>
              <div
                class="absolute flex items-center justify-center h-12 w-12 rounded-md bg-indigo-500 text-white"
              >
                <UserGroupIcon class="w-7 h-7" />
              </div>
              <p class="ml-16 text-lg leading-6 font-medium text-gray-900">
                Share Data Sources with your colleagues
              </p>
            </dt>
            <dd class="mt-2 ml-16 text-base text-gray-500">
              Lorem ipsum, dolor sit amet consectetur adipisicing elit. Maiores
              impedit perferendis suscipit eaque, iste dolor cupiditate
              blanditiis ratione.
            </dd>
          </div>

          <div class="relative">
            <dt>
              <div
                class="absolute flex items-center justify-center h-12 w-12 rounded-md bg-indigo-500 text-white"
              >
                <Cog8ToothIcon class="w-7 h-7" />
              </div>
              <p class="ml-16 text-lg leading-6 font-medium text-gray-900">
                Profile customization at its finest
              </p>
            </dt>
            <dd class="mt-2 ml-16 text-base text-gray-500">
              Lorem ipsum, dolor sit amet consectetur adipisicing elit. Maiores
              impedit perferendis suscipit eaque, iste dolor cupiditate
              blanditiis ratione.
            </dd>
          </div>
        </dl>
      </div>
    </div>
  </AuthenticatedLayout>
</template>
