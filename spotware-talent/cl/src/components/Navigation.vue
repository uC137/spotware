<template>
    <div >
        <nav class="nav">
            <div class="nav-left">
                <router-link class="nav-item"  to="/">
                    <i class="fa fa-book fa-4x" aria-hidden="true"></i>
                </router-link>
            </div>

            <div class="nav-right nav-menu">
                <a href="#" class="nav-item" v-if="authenticated" @click="logOut()">Logout</a>
                <router-link class="nav-item" v-if="!authenticated" to="login">Login</router-link>
                <router-link class="nav-item" v-if="!authenticated" to="signup">Sign Up</router-link>
            </div>
        </nav>
    </div>
</template>

<script>
    import auth from '../auth/index'
    export default {
        name: 'navigation',
        data () {
            return {
                authenticated: auth.checkAuth()
            }
        },

        methods:{
            logOut(){
                auth.logout()
                window.location.href = '/'
            }
        }

    }
</script>



