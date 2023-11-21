import { createRouter, createWebHistory } from 'vue-router/dist/vue-router';

import index from '@/pages/index.vue';
import list from '@/pages/manage/list.vue';
import edit from '@/pages/manage/edit.vue';

/**
 *
 * @type {import('vue-router').RouteRecordRaw[]}
 */
const routes = [
  {
    path: '/',
    name: 'index',
    component: index,
  },
  {
    path: '/manage',
    name: 'manage',
    component: list,
  },
  {
    path: '/manage/:id(\\d+)',
    name: 'edit',
    component: edit,
    props: true,
  },
  {
    path: '/manage/create',
    name: 'create',
    component: edit,
  },
];

const router = createRouter({
  history: createWebHistory('/'),
  routes: routes,
});

export default router;