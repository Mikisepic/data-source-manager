<template>
  <div class="min-h-screen">
    <div
      class="min-h-[91.5vh] flex flex-col sm:justify-center items-center pt-6 bg-gray-100 dark:bg-gray-900"
    >
      <div>
        <Link href="/">
          <ApplicationLogo class="w-20 h-20 fill-current text-gray-500" />
        </Link>
      </div>

      <div
        class="w-full sm:max-w-md mt-6 mb-6 px-6 py-4 bg-white dark:bg-gray-800 shadow-md overflow-hidden sm:rounded-lg"
      >
        <slot />
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
