// 3rd PARTY
import { Head, Link } from '@inertiajs/inertia-vue3';

// LAYOUTS
import AuthenticatedLayout from '@/Layouts/Authenticated.vue';
import GuestLayout from '@/Layouts/Guest.vue';

// COMPONENTS
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import Button from '@/Components/Button.vue';
import Checkbox from '@/Components/Checkbox.vue';
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';
import Input from '@/Components/Input.vue';
import InputError from '@/Components/InputError.vue';
import Label from '@/Components/Label.vue';
import NavLink from '@/Components/NavLink.vue';
import ResponsiveNavLink from '@/Components/ResponsiveNavLink.vue';
import Select from '@/Components/Select.vue';
import SharedDialog from '@/Components/SharedDialog.vue';
import ThemeToggle from '@/Components/ThemeToggle.vue';

export const GlobalComponents = {
  install(app) {
    app.component('Link', Link).component('Head', Head);

    app
      .component('AuthenticatedLayout', AuthenticatedLayout)
      .component('GuestLayout', GuestLayout);

    app
      .component('ApplicationLogo', ApplicationLogo)
      .component('Button', Button)
      .component('Checkbox', Checkbox)
      .component('Dropdown', Dropdown)
      .component('DropdownLink', DropdownLink)
      .component('Input', Input)
      .component('InputError', InputError)
      .component('Label', Label)
      .component('NavLink', NavLink)
      .component('ResponsiveNavLink', ResponsiveNavLink)
      .component('Select', Select)
      .component('SharedDialog', SharedDialog)
      .component('ThemeToggle', ThemeToggle);
  }
};
