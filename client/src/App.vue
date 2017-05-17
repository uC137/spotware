<template>
    <div>

        <div id="app" class="container ">

            <navigation></navigation>

            <router-view></router-view>

            <br><br><br><br><br>
        </div>

        <div class="footer">
            <div class="notification">
                This container is a demo application. <br>

                <p>
                    Developed at: <small>{{datetime}}</small>
                </p>
            </div>
        </div>

    </div>
</template>

<script>
    import Navigation from './components/Navigation.vue'
    export default {
        name: 'app',
        components:{
            Navigation
        },
        data () {
            return {
                datetime: '30/3/2017'
            }
        },
    }
</script>


