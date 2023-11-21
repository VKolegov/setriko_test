import { createRouter, createWebHistory } from 'vue-router/dist/vue-router';

import index from '@/pages/index.vue';
import list from '@/pages/manage/list.vue';
import edit from '@/pages/manage/edit.vue';

/**
 *
 * @type {import('vue-router').RouteRecordRaw[]}
 */
export const routes = [
  {
    path: '/',
    name: 'index',
    component: index,
    meta: {
      title: '',
    }
  },
  {
    path: '/manage',
    name: 'manage',
    component: list,
    meta: {
      title: 'Управление',
    }
  },
  {
    path: '/manage/:id(\\d+)',
    name: 'edit',
    component: edit,
    props: true,
    meta: {
      title: 'Редактирование',
    }
  },
  {
    path: '/manage/create',
    name: 'create',
    component: edit,
    meta: {
      title: 'Создание',
    }
  },
];

const router = createRouter({
  history: createWebHistory('/'),
  routes: routes,
});

let defaultTitle = document.title;

router.afterEach((route) => {
  if (route.meta.title) {
    document.title = `${defaultTitle} | ${route.meta.title}`;
  }
});

export default router;