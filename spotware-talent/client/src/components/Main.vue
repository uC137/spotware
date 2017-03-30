<template>
    <div class="main">
        <p>
        <hr>
        </p>

        <books></books>

    </div>
</template>

<script>
    import auth from '../auth/index'
    import books from "components/book/BXBooks";

    export default {
        name: 'main',
        data () {
            return {
                authenticated: auth.checkAuth()
            }
        },
        methods: {
            logout() {
                auth.logout()
            }
        },
        components:{
            'books' : books
        }
    }
</script>

