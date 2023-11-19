<script setup>
import { computed, onMounted, ref } from 'vue';

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

const currentPage = ref(1);
const maxPage = ref(1);

const pages = computed(() => {
  const arr = new Array(maxPage.value);

  for (let i = 0; i < maxPage.value; i++) {
    arr[i] = i + 1;
  }

  return arr;
});

function goToPage (n) {

  if (n < 1) {
    n = 1;
  }

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
        <router-link :to="{'name': 'short_url', params: {id: url.id}}">
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
        <a :href="url.destination_url"> {{ url.destination_url }} </a>
      </td>
      <td>
        {{ url.hits }}
      </td>
    </tr>
    </tbody>
  </table>

  <nav>
    <ul class="pagination">
      <li
          class="page-item"
          :class="{'disabled': currentPage === 1}"
      >
        <a class="page-link" @click="prevPage">Назад</a>
      </li>
      <li
          v-for="page in pages"
          :key="page"
          class="page-item"
          :class="{'active': currentPage === page}"
      >
        <a class="page-link" @click="goToPage(page)">{{ page }}</a>
      </li>
      <li
          class="page-item"
          :class="{'disabled': currentPage === maxPage}"
      >
        <a class="page-link" @click="nextPage">Вперед</a>
      </li>
    </ul>
  </nav>
</template>

<style scoped>
.page-link {
  cursor: pointer;
}
</style>