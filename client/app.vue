<template>
  <NuxtLayout>
    <NuxtPage />
  </NuxtLayout>
</template>

<script setup>
import { useFetch, useRuntimeConfig } from "nuxt/app";

const config = useRuntimeConfig();
console.log(config.public.apiBase)
const { data } = await useFetch(`${config.public.apiBase}/site/index`);
console.log(data)
</script>
