<script setup>
import { ref } from 'vue';
import { useRouter } from 'vue-router';

import shortUrlsAPI from '@/services/short_urls.js';

const router = useRouter();

const url = ref('');

function onSubmit () {
  createUrl(url.value);
}

async function createUrl (url) {
  const shortUrl = await shortUrlsAPI.create({
    destination_url: url,
  });

  await router.push({
    name: 'edit',
    params: {
      id: shortUrl.id,
    }
  });
}
</script>

<template>
  <section class="main-page">
    <form
        @submit.prevent="onSubmit"
    >
      <div class="mb-3">
        <label
            for="url"
            class="form-label"
        >
          Введите ссылку, чтобы её сократить
        </label>
        <input
            type="text"
            class="form-control"
            id="url"
            v-model="url"
            maxlength="2048"
        >
      </div>

      <button type="submit" class="btn btn-primary">
        Сохранить
      </button>
    </form>
  </section>
</template>

<style scoped>
.main-page {
  padding: 50px 80px;
}
</style>