<template>
    <div>
        {{ $route.params.slug }}
    </div>
</template>

<script>
import { ref } from '@vue/reactivity'
import { onMounted } from '@vue/runtime-core'
import axios from 'axios'
    export default {
        setup(){
            let movie = ref(null)

            onMounted(()=>{
                const slug = '1'
                axios.get(`http://127.0.0.1:8000/api/v1/movie/${slug}`)
                .then(res => {
                    movie = res.data.data
                    console.log(movie);
                })
            })
            
            return{
                movie
            }
        }
    }
</script>

<style lang="scss" scoped>

</style>
