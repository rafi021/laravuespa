<template>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand" :to="{name: 'home'}">Site Logo</a>
            <button
                class="navbar-toggler"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent"
                aria-expanded="false"
                aria-label="Toggle navigation"
            >
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto mb-2 mb-lg-0" v-if="auth">
                    <li class="nav-item">
                        <router-link class="nav-link" :to="{name: 'home'}">Home</router-link>
                    </li>
                    <li class="nav-item" v-if="auth">
                        <router-link class="nav-link" :to="{name: 'category-index'}">Product Category</router-link>
                    </li>
                    <li class="nav-item">
                        <router-link class="nav-link" :to="{name: 'dashboard'}">Dashboard</router-link>
                    </li>
                    <li class="nav-item" v-if="auth">
                        <a href="#" class="nav-link" @click.prevent="logout">Logout</a>
                    </li>
                </ul>
                <ul class="navbar-nav ml-auto" v-else>
                    <li class="nav-item">
                        <router-link class="nav-link" :to="{name: 'login'}">Login</router-link>
                    </li>
                    <!-- <li class="nav-item">
                        <router-link class="nav-link" :to="{name: 'register'}">Register</router-link>
                    </li> -->
                </ul>
                   
            </div>
        </div>
    </nav>
</template>

<script>
export default {
    methods: {
        logout(){
            axios.post('/logout')
            .then((res) =>{
                //console.log('success')
                this.$toast.success({
                    title: "Success",
                    message: "Successfully Logout!!",
                })
                this.$store.commit('SET_AUTHENTICATED', false)
                localStorage.removeItem("auth")
                this.$router.push({name: 'login'})
            })
        }
    },
    computed: {
        auth(){
            return this.$store.getters.getAuthenticated;
        }
    }
};
</script>

<style></style>
