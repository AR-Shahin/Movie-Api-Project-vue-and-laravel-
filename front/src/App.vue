<template>
  <div>
    <navbar/>
        <router-view/>
    <MyFooter/>
  </div>
</template>

<style>

#nav a.router-link-exact-active {
  color: #42b983;
}
</style>

<script>
import Navbar from '@/components/Navbar.vue';
import MyFooter from '@/components/Footer.vue';

export default {
    components: { Navbar,MyFooter },
    
}
</script>
