<template>
    <div>
        <h3>Register</h3>
<div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <form action="" @submit.prevent="handleForm">
                        <input type="name" class="form-control" placeholder="Name" v-model="user.name"> <br>
                        <input type="email" class="form-control" placeholder="Email" v-model="user.email"> <br>
                        <input type="password" class="form-control" placeholder="Password" v-model="user.password"> <br>
                        <button class="btn btn-sm btn-block btn-success">Register</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { reactive } from '@vue/reactivity'
import axios from 'axios'
import { useRouter } from 'vue-router'
    export default {
        setup(){
            const router = useRouter()
            const user = reactive({
                email : '',
                name : '',
                password : '',
            })
            const handleForm = ()=>{
                axios.post("http://127.0.0.1:8000/api/v1/customer/register",user)
                .then(res => {
                    router.push('login')
                    console.log(res);
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
