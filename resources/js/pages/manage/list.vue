<script setup>
import { onMounted, ref } from 'vue';

import short_urls from '@/services/short_urls.js';

/**
 *
 * @type {import('vue').Ref<ShortUrl[]>}
 */
const urls = ref([]);

/**
 *
 * @param {number} page
 * @returns {Promise<void>}
 */
async function fetchEntities (page = 1) {
  try {
    const response = await short_urls.fetch({
      page: page
    });
    urls.value = response.data;
    currentPage.value = response.meta.current_page;
    maxPage.value = response.meta.last_page;

  } catch (e) {
    console.error(e);
  }
}

onMounted(() => {
  fetchEntities();
});

/*
pagination
 */

const futurePage = ref(1);
const currentPage = ref(1);
const maxPage = ref(1);

function onSelectPageSubmit () {
  goToPage(futurePage.value);
}

function goToPage (n) {

  if (n < 1) {
    n = 1;
  }
  futurePage.value = n;

  fetchEntities(n);
}

function nextPage () {
  goToPage(currentPage.value + 1);
}

function prevPage () {
  goToPage(currentPage.value - 1);
}
</script>

<template>
  <table class="table table-hover">
    <thead>
    <tr>
      <th>#</th>
      <th>Короткий ключ</th>
      <th>Название</th>
      <th>Ссылка</th>
      <th>Переходов</th>
    </tr>
    </thead>
    <tbody>
    <tr v-for="url in urls" :key="url.id">
      <td>
        <router-link :to="{'name': 'edit', params: {id: url.id}}">
          {{ url.id }}
        </router-link>
      </td>
      <td>
        <a :href="url.url"> {{ url.slug }} </a>
      </td>
      <td>
        {{ url.name ?? '-' }}
      </td>
      <td>
        <a :href="url.destination_url" target="_blank"> {{ url.destination_url }} </a>
      </td>
      <td>
        {{ url.hits }}
      </td>
    </tr>
    </tbody>
  </table>

  <form
      class="list-nav"
      @submit.prevent="onSelectPageSubmit"
  >
    <div class="input-group mb-3">
      <button
          :disabled="currentPage === 1"
          type="button"
          class="btn btn-primary"
          @click="prevPage"
      >
        Назад
      </button>
      <input
          type="number"
          class="form-control"
          v-model="futurePage"
          min="1"
          :max="maxPage"
      >
      <button
          :disabled="currentPage === maxPage"
          type="button"
          class="btn btn-primary"
          @click="nextPage"
      >
        Вперед
      </button>
    </div>
  </form>
</template>

<style scoped>
.list-nav {
  padding: 50px 0;
}
</style>