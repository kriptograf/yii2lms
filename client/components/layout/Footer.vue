<template>
  <footer class="footer bg-secondary position-relative user-select-none">
    <div class="container">
      <div class="row">
        <div class="col-12">
          <div class=" footer-subscribe d-block d-md-flex align-items-center justify-content-between">
            <div class="flex-grow-1">
              <strong>Присоединяйтесь к нам сегодня</strong>
              <span class="d-block mt-5 text-white">#Мы будем отправлять лучшие предложения на вашу электронную почту.</span>
            </div>
            <div class="subscribe-input bg-white p-10 flex-grow-1 mt-30 mt-md-0">
              <form action="/newsletters" method="post">

                <div class="form-group d-flex align-items-center m-0">
                  <div class="w-100">
                    <input type="text" name="newsletter_email" class="form-control border-0" placeholder="Введите сюда ваш email"/>
                    <div v-if="false" class="invalid-feedback"> Текст ошибки </div>
                  </div>
                  <button type="submit" class="btn btn-primary rounded-pill">Присоединиться</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="container">
      <div class="row">
        <div v-for="column in columns" class="col-6 col-md-3">
          <template v-if="footerColumns[column] !== undefined">
            <span v-if="footerColumns[column]['title'] !== undefined" class="header d-block text-white font-weight-bold">{{ footerColumns[column]['title'] }}</span>
          </template>
          <template v-if="footerColumns[column] !== undefined">
            <div v-if="footerColumns[column]['value'] !== undefined" class="mt-20">
              {{ footerColumns[column]['value'] }}
            </div>
          </template>
        </div>
      </div>

      <div class="mt-40 border-blue py-25 d-flex align-items-center justify-content-between">
        <div class="footer-logo">
          <a href="/">
            <img v-if="generalSettings['footer_logo'] !== undefined" :src="generalSettings.footer_logo" class="img-cover" alt="footer logo">
          </a>
        </div>
        <div class="footer-social">
          <a v-for="social in footerSocials" :href="social.link">
            <img :src="social.image" :alt="social.title" class="mr-15">
          </a>
        </div>
      </div>
    </div>
  </footer>
</template>

<script setup>
import {ref} from "vue";

const props = defineProps({
  footerColumns: {
    type: Object,
    required: true,
  },
  footerSocials: {
    type: Object,
    required: true,
  },
  generalSettings: {
    type: Object,
    required: true,
  }
});

const columns = ref(['first_column','second_column','third_column','forth_column']);

</script>

<style scoped>

</style>