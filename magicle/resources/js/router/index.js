import { createRouter, createWebHashHistory } from 'vue-router';

import DashboardLayout from '../layouts/DashboardLayout.vue';

import Collections from '../views/Collections.vue';
import Collection from '../views/Collection.vue';
import Dashboard from '../views/Dashboard.vue';
import Groups from '../views/Groups.vue';
import Group from '../views/Group.vue';
import Library from '../views/Library.vue';
import Profile from '../views/Profile.vue';
import Settings from '../views/Settings.vue';

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
