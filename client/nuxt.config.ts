// https://nuxt.com/docs/api/configuration/nuxt-config
export default defineNuxtConfig({
  runtimeConfig: {
    public: {
      apiBase: process.env.API_BASE_URL
    },
  },
  ssr: false,
  app: {
    head: {
      link: [
        { rel: 'stylesheet', href: '/css/app.css', type: 'text/css' },
        { rel: 'stylesheet', href: '/css/font.css', type: 'text/css' }
      ],
    },
  },
  modules: [
    'nuxt-icon',
    'nuxt-swiper'
  ]
})
