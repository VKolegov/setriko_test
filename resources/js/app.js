import { createApp } from 'vue/dist/vue.esm-bundler';
import router from './router.js';

import NavMenu from '@/components/NavMenu.vue';

const app = createApp({
  components: {
    NavMenu,
  }
});

app.use(router);

app.mount('#app');

