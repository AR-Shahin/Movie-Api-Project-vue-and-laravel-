<template>
<navbar/>
  <router-view/>
  <AppFooter/>
</template>

<style>

</style>
<script>
import { onMounted } from '@vue/runtime-core'
import AppFooter from './components/Footer.vue'
import Navbar from './components/Navbar.vue'
export default{
    components: { Navbar, AppFooter },
    setup(){
        onMounted(()=>{
            console.log(process.env)
        })
    }
}
</script>
