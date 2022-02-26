<template>
    <div>
        <h1>{{ data.movie.name}}</h1>
        <img :src="`http://127.0.0.1:8000/${data.movie.image}`" alt="" class="img-fluid">
    </div>
</template>

<script>
import { reactive } from '@vue/reactivity'
import { onMounted } from '@vue/runtime-core'
import { useRoute } from 'vue-router'
import axios from 'axios'
    export default {
        setup(){
            const data = reactive({
                movie : {}
            })
            const route = useRoute()
            onMounted(()=>{
                let id = route.params.id
                axios.get(`http://127.0.0.1:8000/api/v1/movie/${id}`)
                .then(res => {
                    data.movie = res.data.data
   
                    // console.log(movie.name);
                })
            })
            
            return{
               data
            }
        }
    }
</script>

<style lang="scss" scoped>

</style>
