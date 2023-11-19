<script setup>
import { onMounted, ref } from 'vue';

import shortUrlsAPI from '@/services/short_urls.js';

const props = defineProps({
  id: {
    type: Number,
  }
});

/**
 *
 * @type {import('vue').Ref<ShortUrl>}
 */
const shortUrl = ref({});

/**
 *
 * @param id
 */
async function fetch (id) {
  try {
    shortUrl.value = await shortUrlsAPI.fetchOne(id);
  } catch (e) {
    console.error(e);
  }
}

onMounted(() => {
  if (props.id) {
    fetch(props.id);
  }
});

function onSubmit () {
  shortUrlsAPI.update(props.id, shortUrl.value).then(
      r => console.log(r)
  );
}
</script>

<template>
  <form
      @submit.prevent="onSubmit"
  >
    <div class="mb-3">
      <label
          for="slug"
          class="form-label"
      >
        Короткий ключ
      </label>
      <input
          type="text"
          class="form-control"
          id="slug"
          :disabled="shortUrl"
          v-model="shortUrl.slug"
          minlength="1"
          maxlength="16"
      >
    </div>

    <div class="mb-3">
      <label
          for="name"
          class="form-label"
      >
        Название
      </label>
      <input
          type="text"
          class="form-control"
          id="name"
          v-model="shortUrl.name"
      >
    </div>

    <div class="mb-3">
      <label
          for="url"
          class="form-label"
      >
        Ссылка
      </label>
      <input
          type="text"
          class="form-control"
          id="url"
          v-model="shortUrl.destination_url"
      >
    </div>

    <button type="submit" class="btn btn-primary">
      Сохранить
    </button>
  </form>
</template>

<style scoped>

</style>