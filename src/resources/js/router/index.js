import { createRouter, createWebHashHistory } from 'vue-router';

import DashboardLayout from '../layouts/DashboardLayout';

import Collections from '../views/Collections';
import Collection from '../views/Collection';
import Dashboard from '../views/Dashboard';
import Groups from '../views/Groups';
import Group from '../views/Group';
import Library from '../views/Library';
import Profile from '../views/Profile';
import Settings from '../views/Settings';

const routes = [
  {
    path: '/',
    redirect: '/dashboard',
    component: DashboardLayout,
    children: [
      {
        path: '/dashboard',
        name: 'dashboard',
        component: Dashboard
      },
      {
        path: '/library',
        name: 'library',
        component: Library
      },
      {
        path: '/collections',
        name: 'collections',
        component: Collections
      },
      {
        path: '/collections/:id',
        name: 'previewCollection',
        component: Collection,
        props: true
      },
      {
        path: '/groups',
        name: 'groups',
        component: Groups
      },
      {
        path: '/groups/:id',
        name: 'previewGroup',
        component: Group,
        props: true
      },
      {
        path: '/profile/:id',
        name: 'profile',
        component: Profile,
        props: true
      },
      {
        path: '/settings/:id',
        name: 'settings',
        component: Settings,
        props: true
      }
    ]
  }
];

export const Router = createRouter({
  history: createWebHashHistory(),
  linkActiveClass: 'active',
  routes
});
