import { createApp } from 'vue/dist/vue.esm-bundler';
import router from './router.js';

const app = createApp({});

app.use(router);

app.mount('#app');

