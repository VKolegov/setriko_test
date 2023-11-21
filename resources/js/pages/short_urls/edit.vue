<script setup>
import { onMounted, ref } from 'vue';

import shortUrlsAPI from '@/services/short_urls.js';
import { useRouter } from 'vue-router';

const router = useRouter();

const props = defineProps({
  id: {
    type: Number,
  }
});

/**
 *
 * @type {import('vue').Ref<ShortUrl | ShortUrlCreateData | ShortUrlUpdateData>}
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
  if (props.id) {
    update();
  } else {
    create();
  }
}

async function update () {
  try {
    shortUrl.value = await shortUrlsAPI.update(props.id, shortUrl.value);
  } catch (e) {
    console.error(e);
  }
}

async function create () {
  try {
    shortUrl.value = await shortUrlsAPI.create(shortUrl.value);
    await router.push({
      name: 'short_urls.edit',
      params: {
        id: shortUrl.value.id,
      }
    });
  } catch (e) {
    console.error(e);
  }
}

/*
slug generation
 */

const slugLength = ref(3);

async function generateSlug () {
  try {
    shortUrl.value.slug = await shortUrlsAPI.getFreeSlug(slugLength.value);
  } catch (e) {
    console.error(e);
  }
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
      <div class="input-group">
        <input
            type="text"
            class="form-control"
            id="slug"
            :disabled="shortUrl.id"
            v-model="shortUrl.slug"
            minlength="1"
            maxlength="16"
        >
        <button
            :disabled="shortUrl.id"
            type="button"
            class="btn btn-outline-secondary"
            @click="generateSlug"
        >
          🎲
        </button>
      </div>
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