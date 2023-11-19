import { createRouter, createWebHistory } from 'vue-router/dist/vue-router';

import index from '@/pages/index.vue';
import list from '@/pages/short_urls/list.vue';

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
  }
];

const router = createRouter({
  history: createWebHistory('/'),
  routes: routes,
});

export default router;