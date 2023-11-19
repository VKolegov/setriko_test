import { createRouter, createWebHistory } from 'vue-router/dist/vue-router';

import index from '@/pages/index.vue';
import list from '@/pages/short_urls/list.vue';
import edit from '@/pages/short_urls/edit.vue';

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
    path: '/short_urls',
    name: 'short_urls',
    component: list,
  },
  {
    path: '/short_urls/:id',
    name: 'short_url',
    component: edit,
    props: true,
  }
];

const router = createRouter({
  history: createWebHistory('/'),
  routes: routes,
});

export default router;