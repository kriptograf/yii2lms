<template>
  <div class="dropdown">
    <button type="button" class="btn btn-transparent dropdown-toggle" @click="showNotifications = !showNotifications">
      <Icon name="uil:bell" size="20" class="mr-10" />
      <span v-if="unReadNotifications.length" class="badge badge-circle-danger d-flex align-items-center justify-content-center">{{ unReadNotifications.length }}</span>
    </button>

    <div v-show="showNotifications" class="dropdown-menu pt-20" :class="{ show: showNotifications }">
      <div class="d-flex flex-column h-100">
        <div class="mb-auto navbar-notification-card" data-simplebar>
          <div class="border-bottom mb-20 pb-10 text-right">
            <Icon name="uil:x" size="32" class="close-dropdown mr-10" @click="showNotifications = !showNotifications" />
          </div>

          <template v-if="unReadNotifications.length">
            <a v-for="unReadNotification in unReadNotifications" href="/panel/notifications?notification=$unReadNotification->id">
              <div class="navbar-notification-item border-bottom">
                <h4 class="font-14 font-weight-bold text-secondary">{{ unReadNotification.title }}</h4>
                <span class="notify-at d-block mt-5">{{ unReadNotification.created_at }}</span>
              </div>
            </a>
          </template>
          <div v-else class="d-flex align-items-center text-center py-50">
            <Icon name="uil:bell" size="20" class="mr-10" />
            <span class="">Нет новых уведомлений</span>
          </div>
        </div>

        <div v-if="unReadNotifications.length" class="mt-10 navbar-notification-action">
          <a href="/panel/notifications" class="btn btn-sm btn-danger btn-block">Показать все уведомления</a>
        </div>

      </div>
    </div>
  </div>
</template>

<script setup>
import { useFetch, useRuntimeConfig } from "nuxt/app";
import {ref} from "vue";

const unReadNotifications = ref([]);

const showNotifications = ref(false);

const config = useRuntimeConfig();

useFetch(`${config.public.apiBase}/site/notifications`).then((resp) => {
  console.log('ТщешашсфешщтыCartDropdown', resp.data.value.unReadNotifications);
  unReadNotifications.value = resp.data.value.unReadNotifications;
});

</script>

<style scoped>

</style>