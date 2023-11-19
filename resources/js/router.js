import { createRouter, createWebHistory } from 'vue-router/dist/vue-router';

import index from './pages/index.vue';

/**
 *
 * @type {import('vue-router').RouteRecordRaw[]}
 */
const routes = [
  {
    path: '/',
    name: 'index',
    component: index,
  }
];

const router = createRouter({
  history: createWebHistory('/'),
  routes: routes,
});

export default router;