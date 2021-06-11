<template>
    <div class="container">
        <div class="py-5">
            <div class="row">
                <div class="col-6 offset-3">
                    <div class="card card-default">
                        <div class="card-header">
                            Login Page
                        </div>
                        <div class="card-body">
                            <form action="" method="post" @submit.prevent="login">
                                <div class="form-group">
                                    <label for="">Email</label>
                                    <input type="text" class="form-control" placeholder="Email" v-model="loginForm.email" name="email">
                                    <div v-if="loginForm.errors.has('email')" v-html="loginForm.errors.get('email')" />
                                </div>
                                <div class="form-group">
                                    <label for="">Password</label>
                                    <input type="password" class="form-control" placeholder="Password" v-model="loginForm.password" name="password">
                                     <div v-if="loginForm.errors.has('password')" v-html="loginForm.errors.get('password')" />
                                </div>
                                <div class="form-group">
                                    <button type="submit" :disabled="loginForm.busy" class="btn btn-primary">Log In</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import Form from "vform";
import axios from 'axios';
export default {
    data(){
        return{
            loginForm: new Form({
                email: '',
                password: ''
            })
        }
    },
    methods: {
        login(){
            axios.get('/sanctum/csrf-cookie').then(response => {
                axios.post('/login', this.loginForm)
            }).then((res) => {
                //console.log(res)
                this.getUser();
            });
        },
        getUser(){
            axios.get('/api/user')
            .then((res) => {
                console.log(res.data)
            }).catch((err) =>{
                console.log(err.response.data)
            })
        }
    },
    mounted(){
        this.getUser();
    }
};
</script>

<style></style>
