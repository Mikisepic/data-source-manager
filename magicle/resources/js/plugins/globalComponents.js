import ButtonBase from '../components/ButtonBase.vue';
import Card from '../components/Card.vue';
import DropdownBase from '../components/DropdownBase.vue';
import InputBase from '../components/InputBase.vue';
import NavbarItem from '../components/Navbar/NavbarItem.vue';
import NavbarWrapper from '../components/Navbar/NavbarWrapper.vue';
import TableBase from '../components/TableBase.vue';
import ThemeToggle from '../components/ThemeToggle.vue';

export const GlobalComponents = {
  install(app) {
    app.component('button-base', ButtonBase);
    app.component('card', Card);
    app.component('dropdown-base', DropdownBase);
    app.component('input-base', InputBase);
    app.component('navbar-item', NavbarItem);
    app.component('navbar-wrapper', NavbarWrapper);
    app.component('table-base', TableBase);
    app.component('theme-toggle', ThemeToggle);
  }
};
