// The Vue build version to load with the `import` command
// (runtime-only or standalone) has been set in webpack.base.conf with an alias.
import Vue from "vue";
import App from "./App";
import router from "./router";
import ElementUI from "element-ui";
import Axios from "axios";
import "element-ui/lib/theme-default/index.css";
import VeeValidate from "vee-validate";
import VueCookie from "vue-cookie";
import auth from "./auth/index";
import config from "./config"
//GLOBAL APP Configuration
Vue.prototype.$conf = config.init()


const validationConfig = {
    errorBagName: 'errors', // change if property conflicts.
    fieldsBagName: 'fields',
    delay: 0,
    locale: 'en',
    dictionary: null,
    strict: true,
    enableAutoClasses: false,
    classNames: {
        touched: 'touched', // the control has been blurred
        untouched: 'untouched', // the control hasn't been blurred
        valid: 'valid', // model is valid
        invalid: 'invalid', // model is invalid
        pristine: 'pristine', // control has not been interacted with
        dirty: 'dirty' // control has been interacted with
    }
};

Vue.use(VeeValidate, validationConfig);
Vue.use(ElementUI)
Vue.use(VueCookie);
Vue.prototype.$http = Axios



router.beforeEach((to, from, next) => {
    Axios.defaults.headers.common['Authorization'] = 'Bearer ' + localStorage.getItem('token');
    if (to.meta.auth) {
        // this route requires auth, check if logged in
        // if not, redirect to login page.
        if (!auth.checkAuth()) {
            next('/login')
        } else {
            next()
        }
    } else {
        next() // make sure to always call next()!
    }
})



/* eslint-disable no-new */
new Vue({
    el: '#app',
    router,
    template: '<App/>',
    components: {App},
})
