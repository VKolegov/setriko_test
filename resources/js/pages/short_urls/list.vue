<script setup>
import { onMounted, ref } from 'vue';

import short_urls from '@/services/short_urls.js';

/**
 *
 * @type {import('vue').Ref<ShortUrl[]>}
 */
const urls = ref([]);

async function fetchEntities () {
  try {
    const response = await short_urls.fetch();
    urls.value = response.data;

  } catch (e) {
    throw e;
  }
}

onMounted(() => {
  fetchEntities();
});
</script>

<template>
  <table>
    <tr>
      <th>
        #
      </th>
      <th>
        Короткий ключ
      </th>
      <th>
        Название
      </th>
      <th>
        Ссылка
      </th>
      <th>
        Переходов
      </th>
    </tr>
    <tr v-for="url in urls" :key="url.id">
      <td>
        {{ url.id }}
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
  </table>
</template>

<style scoped>

</style>