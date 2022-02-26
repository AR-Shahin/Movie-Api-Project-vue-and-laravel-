<template>
  <div id="nav">
    <router-link to="/">Home</router-link> |
    <router-link to="/about">About</router-link> | 
    <router-link to="/reg">Register</router-link> | 
    <router-link to="/login">Login</router-link> | 
    <button @click="logout">Logout </button>

  </div>
  <router-view/>
</template>

<style>
#app {
  font-family: Avenir, Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
}

#nav {
  padding: 30px;
}

#nav a {
  font-weight: bold;
  color: #2c3e50;
}

#nav a.router-link-exact-active {
  color: #42b983;
}
</style>
<script>
import { reactive } from '@vue/reactivity'
import axios from 'axios'
import { useRouter } from 'vue-router';
export default {
     setup(){
            const user = reactive({
                email : '',
                password : '',
            });
            const router = useRouter()
            let token = localStorage.getItem("authToken");
           
            const logout = ()=>{
                axios.defaults.headers.common['Authorization'] = 'Bearer ' + token;
                axios.post("http://127.0.0.1:8000/api/v1/customer/logout")
                .then(res => {
                    
                    router.push('login')

                    console.log(res.data)
                }).catch(err => {
                    console.log(err);
                })
            }

            return {
                logout,user,token
            }
        }
}
</script>
