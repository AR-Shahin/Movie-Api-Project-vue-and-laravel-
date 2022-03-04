<template>
<navbar/>
  <router-view/>
  <AppFooter/>
</template>

<style>

</style>
<script>
import AppFooter from './components/Footer.vue'
import Navbar from './components/Navbar.vue'
export default{
    components: { Navbar, AppFooter },

}
</script>
