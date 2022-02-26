<template>
  <div class="home">
    <!-- <img alt="Vue logo" src="../assets/logo.png"> -->
    {{ title }}
    <div class="container">
        <div class="row">
            <div class="col-md-3" v-for="movie in data.movies" :key="movie.id">
                <div class="card">
                    <div class="card-body">
                        <router-link  :to="`/single/${movie.id}`">
                        <h4>{{movie.name}}</h4>
                        <p>{{movie.description}}</p>
                        <img :src="`http://127.0.0.1:8000/${movie.image}`" alt="" class="img-fluid">
                        </router-link >
                    </div>
                </div>
            </div>
        </div>
    </div>
  </div>
</template>

<script>
// @ is an alias to /src

import { reactive, ref } from '@vue/reactivity'
import { onMounted } from '@vue/runtime-core'
import axios from 'axios'
export default {
  name: 'Home',
  components: {
    
  },
  setup(){
    const title = ref('Movie API test')
    const data = reactive({
        movies: []
    })
    
    onMounted(() => {
        axios.get('http://127.0.0.1:8000/api/v1/movie/').then(res => {
            data.movies = res.data.data
        })
    })


    return{
    title,data
    }
  }

}
</script>
