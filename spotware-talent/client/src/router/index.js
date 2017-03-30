import Vue from "vue";
import Router from "vue-router";
import Main from "components/Main";
import Login from "components/Login";
import Signup from "components/Signup";
import Books from "components/book/BXBooks";
import BookDetails from "components/book/BXBookDetails";
import notFound from "components/NotFound"


Vue.use(Router)

export default new Router({
    mode: 'history',
    linkActiveClass: 'is-active',
    routes: [
        {path: '/', name: 'Main', component: Main, meta : {auth:false}},
        {path: '/login', name: 'Login', component: Login, meta : {auth:false}},
        {path: '/signup', name: 'Signup', component: Signup, meta : {auth:false}},
        {path: '/logout', name: 'Logout', component: Login, meta : {auth:true}},
        {path: '/books', name: 'Books', component: Books, meta : {auth:false}},

        //Authenticated urls
        {path: '/books/:isbn', name: 'BookDetails', component: BookDetails, meta : {auth:true}},


        //Not found
        {path: '/*', name: 'notFound', component: notFound, meta : {auth:false}},


    ]
});

