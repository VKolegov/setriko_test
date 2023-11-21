<script setup>
import { useRouter } from 'vue-router';

const router = useRouter();

const menuItems = [
  { route_name: 'index', title: 'Главная', },
  { route_name: 'manage', title: 'Управление', },
  { route_name: 'create', title: 'Создать ссылку', },
];
</script>

<template>
  <nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
      <a class="navbar-brand" href="/">URL Shortener</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
              aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
          <li
              v-for="menuItem in menuItems"
              :key="menuItem.route_name"
              class="nav-item"
          >
            <router-link
                :to="{name: menuItem.route_name}"
                class="nav-link"
                active-class="active"
            >
              {{ menuItem.title }}
            </router-link>
          </li>
          <!--          <li class="nav-item">-->
          <!--            <router-link-->
          <!--                :to="{'name': 'index'}"-->
          <!--            >-->
          <!--              Главная-->
          <!--            </router-link>-->
          <!--            <a class="nav-link active" aria-current="page" href="#">Главная</a>-->
          <!--          </li>-->
          <!--          <li class="nav-item">-->
          <!--            <a class="nav-link" href="#">Управление</a>-->
          <!--          </li>-->
          <!--          <li class="nav-item">-->
          <!--            <a class="nav-link" href="#">Создать ссылку</a>-->
          <!--          </li>-->
        </ul>
      </div>
    </div>
  </nav>
</template>

<style scoped>

</style>