<template>
    <div>
        <h3>Login</h3>
        <hr>
        <div class="container">
            <div class="btn btn-success">dd</div>
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <form action="" @submit.prevent="handleForm">
                        <input type="email" class="form-control" placeholder="Email" v-model="user.email"> <br>
                        <input type="password" class="form-control" placeholder="Password"  v-model="user.password"> <br>
                        <button class="btn btn-sm btn-block btn-success">Login</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

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
            const handleForm = ()=>{
                axios.post("http://127.0.0.1:8000/api/v1/customer/login",user)
                .then(res => {
                    localStorage.setItem("authToken", res.data.access_token);
                    router.push('about')

                    // console.log(res.data.access_token)
                }).catch(err => {
                    console.log(err);
                })
            }

            return {
                handleForm,user
            }
        }
    }
</script>

<style lang="scss" scoped>

</style>
