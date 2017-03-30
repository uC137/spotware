import {router} from "vue-router";
import axios from "axios";
import config from '../config'
const LOGIN_URL = config.init().API_URL + 'auth'
const SIGNUP_URL = config.init().API_URL + 'register'


export default {

    user: {
        authenticated: false
    },

    login(context, creds, redirect) {
        axios.post(LOGIN_URL, creds)
            .then((res) => {
                localStorage.setItem('token', res.data.token)
                this.user.authenticated = true
                if (redirect) {
                    window.location.href = redirect
                }
            })
            .catch(error => context.error = error);
    },

    signup(context, creds, redirect) {

        axios.post(SIGNUP_URL, creds)
            .then((res) => {
                //localStorage.setItem('token', res.data.token)
                this.user.authenticated = true
                if (redirect) {
                    window.location.href = redirect
                }
            })
            .catch(error => context.error = error);
    },

    logout() {
        localStorage.removeItem('token')
        this.user.authenticated = false
    },

    checkAuth() {
        var jwt = localStorage.getItem('token')
        if (jwt) {
            return this.user.authenticated = true
        }
        else {
            return this.user.authenticated = false
        }
    },

    getAuthHeader() {
        return {
            'Authorization': 'Bearer ' + localStorage.getItem('token')
        }
    }
}