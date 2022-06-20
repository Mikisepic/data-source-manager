import ButtonBase from '../components/ButtonBase';
import Card from '../components/Card';
import DropdownBase from '../components/DropdownBase';
import InputBase from '../components/InputBase';
import NavbarItem from '../components/Navbar/NavbarItem';
import NavbarWrapper from '../components/Navbar/NavbarWrapper';
import TableBase from '../components/TableBase';
import ThemeToggle from '../components/ThemeToggle';

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
