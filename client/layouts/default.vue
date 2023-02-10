<template>
  <div>
    <TopNav :generalSettings="generalSettings" />
    <NavBar :generalSettings="generalSettings" :categories="categories" />
    <slot />
    <Footer :footerColumns="footerColumns" :footerSocials="footerSocials" :generalSettings="generalSettings" />
  </div>
</template>

<script setup>
import TopNav from "~/components/layout/TopNav.vue";
import NavBar from "~/components/layout/NavBar.vue";
import Footer from "~/components/layout/Footer.vue";
import { useFetch, useRuntimeConfig } from "nuxt/app";
import { ref } from 'vue';

const config = useRuntimeConfig();

const generalSettings = ref({});

const navbarPages = ref({});

const footerColumns = ref([]);

const footerSocials = ref({});

const categories = ref({});

useFetch(`${config.public.apiBase}/site/settings`).then((resp) => {
  console.log(resp.data.value.generalSettings);
  generalSettings.value = resp.data.value.generalSettings;
  navbarPages.value = resp.data.value.navbarPages;
  footerColumns.value = resp.data.value.footerColumns;
  footerSocials.value = resp.data.value.footerSocials;
});

useFetch(`${config.public.apiBase}/site/categories`).then((resp) => {
  console.log(resp.data.value.categories);
  categories.value = resp.data.value.categories;
});
</script>

<style scoped>

</style>