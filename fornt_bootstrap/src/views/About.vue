<template>
  <div class="about">
    <h1>This is an about page</h1>
    <form action="" @submit.prevent="handleForm">
        <input type="text" class="form-control" v-model="movie.name"> <br>
        <textarea name="" id="" cols="30" rows="10" v-model="movie.description"></textarea>
        <input type="checkbox" :value="i" v-for="i in 5" :key="i" v-model="movie.categories">
        <button class="btn btn-success">Submit</button>
    </form>
  </div>
</template>


<script>
import { reactive } from '@vue/reactivity'
import axios from 'axios'
export default {
    setup(){
        const movie = reactive({
            name : '',
            description : '',
            categories : [],
        })

        const handleForm = () =>{
            axios.post('http://127.0.0.1:8000/api/v1/movie/',movie)
            .then(res => {
                console.log(res)
            }).catch(err => {
                console.log(err)
            })
            // console.log(movie);
        }
        return {
            movie,handleForm
        }
    }
}
</script>
