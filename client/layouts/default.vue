<template>
  <div>
    <TopNav />
    <NavBar />
    <slot />
    <Footer />
  </div>
</template>

<script>
import TopNav from "../components/layout/TopNav";
import NavBar from "../components/layout/NavBar";
import Footer from "../components/layout/Footer";
export default {
  name: "default",
  components: {Footer, NavBar, TopNav}
}
</script>

<style scoped>

</style>