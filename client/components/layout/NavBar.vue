<template>
<div>
  <div id="navbarVacuum"></div>
  <nav id="navbar" class="navbar navbar-expand-lg navbar-light">
    <div class="container">
      <div class="d-flex align-items-center justify-content-between w-100">
        <a class="navbar-brand navbar-order mr-0" href="/">
          <img v-if="generalSettings.logo" :src="generalSettings.logo" class="img-cover" alt="site logo">
        </a>

        <button class="navbar-toggler navbar-order" type="button" id="navbarToggle">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="mx-lg-30 d-none d-lg-flex flex-grow-1 navbar-toggle-content " id="navbarContent">
          <div class="navbar-toggle-header text-right d-lg-none">
            <button class="btn-transparent" id="navbarClose">
              <Icon name="uil:times" size="32" class="mr-10" />
            </button>
          </div>

          <ul class="navbar-nav mr-auto d-flex align-items-center">
            <li v-if="categories.length" class="mr-lg-25">
              <div class="menu-category">
                <ul>
                  <li class="cursor-pointer user-select-none d-flex xs-categories-toggle" @click="showCategories = !showCategories" :class="{ 'show-items': showCategories}">
                    <Icon name="uil:apps" size="20" class="mr-10 d-none d-lg-block" /> Категории

                    <ul class="cat-dropdown-menu">
                      <li v-for="category in categories">
                        <a :href="category.subCategories.length ? '#!' : category.url">
                          <div class="d-flex align-items-center">
                            <img v-if="category.icon" :src="category.icon" class="cat-dropdown-menu-icon mr-10" :alt="category.title + 'icon'">
                            {{ category.title }}
                          </div>

                          <Icon v-if="category.subCategories.length" name="uil:angle-right" size="20" class="d-none d-lg-inline-block ml-10" />
                          <Icon v-if="category.subCategories.length" name="uil:angle-down" size="20" class="d-inline-block d-lg-none" />
                        </a>

                        <ul v-if="category.subCategories.length" class="sub-menu" style="">
                          <li v-for="subCategory in category.subCategories">
                            <a :href="subCategory.url"> {{ subCategory.title }}</a>
                          </li>
                        </ul>
                      </li>
                    </ul>
                  </li>
                </ul>
              </div>
            </li>

            <template v-if="navbarPages.length">
              <li class="nav-item" v-for="navbarPage in navbarPages">
                <a class="nav-link" :href="navbarPage.link">{{ navbarPage.title }}</a>
              </li>
            </template>
          </ul>
        </div>

        <div class="nav-icons-or-start-live navbar-order">

          <template v-if="authUser">
            <a :href="authUser ? '/login' : (authUser.isAdmin ? '/admin/webinars/create' : ((authUser.isUser) ? '/become_instructor' : '/panel/webinars/new'))" class="d-none d-lg-flex btn btn-sm btn-primary nav-start-a-live-btn">
              {{ authUser || !authUser.isUser ? 'Начать новый курс' : (authUser.isUser ? 'Стать инструктором' : '') }}
            </a>

            <a :href="authUser ? '/login' : ((authUser.isUser) ? '/become_instructor' : '/panel/webinars/new')" class="d-flex d-lg-none text-primary nav-start-a-live-btn font-14">
              {{ authUser || !authUser.isUser ? 'Начать новый курс' : (authUser.isUser ? 'Стать инструктором' : '') }}
            </a>
          </template>

          <div class="d-none nav-notify-cart-dropdown top-navbar ">
            <ShoppingCartDropdown />

            <div class="border-left mx-15"></div>

            <NotificationDropdown />
          </div>

        </div>
      </div>
    </div>
  </nav>
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
  },
  categories: {
    type: Object,
    required: true
  },
  navbarPages: {
    type: Object,
    default: {},
  }
});

const showCategories = ref(false);

const authUser = ref(null);

</script>

<style scoped>

</style>