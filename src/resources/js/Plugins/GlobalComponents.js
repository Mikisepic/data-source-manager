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

import Close from '@/Icons/Close.vue';
import MenuAlt from '@/Icons/MenuAlt.vue';

export const GlobalComponents = {
  install(app) {
    app.component('Link', Link);
    app.component('Head', Head);

    app.component('AuthenticatedLayout', AuthenticatedLayout);
    app.component('GuestLayout', GuestLayout);

    app.component('ApplicationLogo', ApplicationLogo);
    app.component('Button', Button);
    app.component('Checkbox', Checkbox);
    app.component('Dropdown', Dropdown);
    app.component('DropdownLink', DropdownLink);
    app.component('Input', Input);
    app.component('InputError', InputError);
    app.component('Label', Label);
    app.component('NavLink', NavLink);
    app.component('ResponsiveNavLink', ResponsiveNavLink);
    app.component('Select', Select);
    app.component('SharedDialog', SharedDialog);
    app.component('ThemeToggle', ThemeToggle);

    app.component('MenuAlt', MenuAlt);
    app.component('Close', Close);
  }
};
