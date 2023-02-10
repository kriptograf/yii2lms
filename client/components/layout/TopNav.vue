<template>
  <div class="top-navbar d-flex border-bottom">
    <div class="container d-flex justify-content-between flex-column flex-lg-row">
      <div class="top-contact-box border-bottom d-flex flex-column flex-md-row align-items-center justify-content-center">
        <h1>{{ generalSettings.site_language }}</h1>
        <div class="d-flex align-items-center justify-content-center">
          <span class="d-flex align-items-center py-10 py-lg-0 text-dark-blue font-14">
            <Icon name="uil:phone-volume" size="20" class="mr-10" />
            {{ generalSettings.site_phone }}
          </span>
          <div class="border-left mx-5 mx-lg-15 h-100"></div>

          <span class="d-flex align-items-center py-10 py-lg-0 text-dark-blue font-14">
            <Icon name="uil:envelope" size="20" class="mr-10" />
            {{ generalSettings.site_email }}
          </span>
        </div>

        <div class="d-flex align-items-center justify-content-between justify-content-md-center">
          <form action="/locale" method="post" class="mr-15 mx-md-20">
            <input type="hidden" name="locale">
            <div class="language-select">
              <div id="localItems"></div>
            </div>
          </form>

          <form action="/search" method="get" class="form-inline my-2 my-lg-0 navbar-search position-relative">
            <input class="form-control mr-5 rounded" type="text" name="search" placeholder="Поиск" aria-label="Поиск">
            <button type="submit" class="btn-transparent d-flex align-items-center justify-content-center search-icon">
              <Icon name="uil:search-alt" size="20" class="mr-10" />
            </button>
          </form>
        </div>
      </div>

      <div class="xs-w-100 d-flex align-items-center justify-content-between ">
        <div class="d-flex">

          <ShoppingCartDropdown />

          <div class="border-left mx-5 mx-lg-15"></div>

          <NotificationDropdown />
        </div>


        <div v-if="authUser" class="dropdown">
          <a href="#!" class="navbar-user d-flex align-items-center ml-50 dropdown-toggle" type="button" @click="showUserDropdown = !showUserDropdown">
            <img :src="authUser.avatar" class="rounded-circle" :alt="authUser.full_name">
            <span class="font-16 user-name ml-10 text-dark-blue font-14">{{ authUser.full_name }}</span>
          </a>

          <div v-show="showUserDropdown" class="dropdown-menu user-profile-dropdown" :class="{ show: showUserDropdown }">
            <div class="d-md-none border-bottom mb-20 pb-10 text-right">
              <Icon name="uil:x" size="32" class="close-dropdown mr-10" @click="showUserDropdown = !showUserDropdown" />
            </div>

            <a class="dropdown-item" :href="authUser.isAdmin ? '/admin' : '/panel' ">
              <img src="/img/icons/sidebar/dashboard.svg" width="25" alt="nav-icon">
              <span class="font-14 text-dark-blue">Админка</span>
            </a>
            <a v-if="authUser.isTeacher" class="dropdown-item" :href="authUser.profileUrl">
              <img src="/img/icons/profile.svg" width="25" alt="nav-icon">
              <span class="font-14 text-dark-blue">Личный кабинет</span>
            </a>
            <a class="dropdown-item" href="/logout">
              <img src="/img/icons/sidebar/logout.svg" width="25" alt="nav-icon">
              <span class="font-14 text-dark-blue">Выход</span>
            </a>
          </div>
        </div>

        <div v-else class="d-flex align-items-center ml-md-50">
          <a href="/login" class="py-5 px-10 mr-10 text-dark-blue font-14">Вход</a>
          <a href="/register" class="py-5 px-10 text-dark-blue font-14">Регистрация</a>
        </div>

      </div>
    </div>
  </div>
</template>

<script setup>
import ShoppingCartDropdown from "./ShoppingCartDropdown";
import NotificationDropdown from "./NotificationDropdown";
import {ref} from "vue";

const props = defineProps({
  generalSettings: {
    type: Object,
    required: true,
  }
});

const authUser = ref(null);

const showUserDropdown = ref(false);

console.log('TopNav', props.generalSettings)
</script>

<style scoped>

</style>