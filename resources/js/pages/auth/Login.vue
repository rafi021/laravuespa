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
                                    <input type="text" class="form-control" placeholder="Email" v-model="loginForm.email" name="email" :class="{'is-invalid': loginForm.errors.has('email')}">
                                    <div class="text-danger" v-if="loginForm.errors.has('email')" v-html="loginForm.errors.get('email')" />
                                </div>
                                <div class="form-group">
                                    <label for="">Password</label>
                                    <input type="password" class="form-control" placeholder="Password" v-model="loginForm.password" name="password" :class="{'is-invalid': loginForm.errors.has('password')}">
                                     <div class="text-danger" v-if="loginForm.errors.has('password')" v-html="loginForm.errors.get('password')" />
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">Log In</button>
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
import { Form } from "vform";
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
        async login(){
            await axios.get('/sanctum/csrf-cookie')
            await this.loginForm.post('/login')
            await this.getUser();
            this.$toast.success({
                title: "Success",
                message: "Welcome, to Dashboard.",
            });
            this.$router.push({name: 'dashboard'})          
        },
        async getUser(){
            await axios.get('/api/user')
            .then((res) => {
                //console.log(res.data)
                let user = res.data;
                this.$store.commit('SET_USER', user);
                this.$store.commit('SET_AUTHENTICATED', true)
                localStorage.setItem("auth", true);
            })
        }
    },
    mounted(){
        //this.getUser();
    }
};
</script>

<style></style>
