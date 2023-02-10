<template>
  <div class="dropdown">
    <button type="button" class="btn btn-transparent dropdown-toggle" @click="showCarts = !showCarts">
      <Icon name="uil:shopping-cart-alt" size="20" class="mr-10" />
      <span class="badge badge-circle-primary d-flex align-items-center justify-content-center">{{ userCarts.length }}</span>
    </button>

    <div v-show="showCarts" class="dropdown-menu" :class="{ show: showCarts }">
      <div class="border-bottom mb-20 pb-10 text-right">
        <Icon name="uil:x" size="32" class="close-dropdown mr-10" @click="showCarts = !showCarts" />
      </div>
      <div class="h-100">
        <div class="navbar-shopping-cart h-100" data-simplebar>
          <div class="mb-auto">
            <div v-for="cart in userCarts" class="navbar-cart-box d-flex align-items-center">
              <a :href="cart.webinar.getUrl" target="_blank" class="navbar-cart-img">
                <img :src="cart.webinar.imgPath" alt="product title" class="img-cover"/>
              </a>
              <div v-if="true" class="navbar-cart-info">
                <a :href="cart.webinar.getUrl" target="_blank">
                  <h4>{{ cart.webinar.title }}</h4>
                </a>
                <div class="price mt-10">
                  <!--                                                                   $cart->webinar->getDiscount($cart->ticket)     -->
                  <span class="text-primary font-weight-bold">{{ cart.webinar.price }} - {{ cart.webinar.getDiscount }}</span>
                  <span v-if="true" class="off ml-15">{{ cart.webinar.price }}</span>
                  <!--                                               $currency  $cart->webinar->price     -->
                  <span v-else class="text-primary font-weight-bold">{{ cart.webinar.price }}</span>
                </div>
              </div>
              <div v-else class="navbar-cart-img">
                <img :src="cart.webinar.imgPath" alt="product title" class="img-cover"/>
              </div>

              <div class="navbar-cart-info">
                <h4 v-if="cart.reserve_meeting_id">Забронирован митинг</h4>

                <div class="price mt-10">
                  <span class="text-primary font-weight-bold">
                    {{ cart.reserveMeeting.meeting.amount }}
                  </span>
                </div>
              </div>
            </div>
          </div>
          <div v-if="userCarts.length" class="navbar-cart-actions">
            <div class="navbar-cart-total mt-15 border-top d-flex align-items-center justify-content-between">
              <strong class="total-text">Всего</strong>
              <strong class="text-primary font-weight-bold">$currency  !empty($totalCartsPrice) ? $totalCartsPrice : 0</strong>
            </div>

            <a href="/cart/" class="btn btn-sm btn-primary btn-block mt-50 mt-md-15"> В корзину </a>
          </div>
          <div v-else class="d-flex align-items-center text-center py-50">
            <Icon name="uil:shopping-cart-alt" size="20" class="mr-10" />
            <span class="">Ваша корзина пуста</span>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { useFetch, useRuntimeConfig } from "nuxt/app";
import {ref} from "vue";

const userCarts = ref([]);

const showCarts = ref(false);

const config = useRuntimeConfig();

useFetch(`${config.public.apiBase}/site/cart`).then((resp) => {
  console.log('ShoppingCartDropdown', resp.data.value.userCarts);
  userCarts.value = resp.data.value.userCarts;
});
</script>

<style scoped>

</style>