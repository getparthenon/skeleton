import {createRouter, createWebHistory} from 'vue-router'

import axios from "axios";
import LandingPage from "../components/LandingPage";
import Login from "../components/Login";


export const router = createRouter({
    history: createWebHistory(),
    routes: [
        { path: '/', component: LandingPage },
        { path: '/login', component: Login },
        // otherwise redirect to home
        { path: '/:pathMatch(.*)/', redirect: '/' }
    ]
});

router.beforeEach((to, from, next) => {
    // redirect to login page if not logged in and trying to access a restricted page
    const publicPages = ['/login', '/signup', '/signup/:code', '/forgot-password', '/forgot-password/:code', '/confirm-email/:code', '/'];
    const authRequired = !publicPages.includes(to.matched[0].path);
    const loggedIn = localStorage.getItem('user');


    if (authRequired && !loggedIn) {
        return next('/login');
    }

    next();
})

// Handle redirections when logged out.
axios.interceptors.response.use(response => {
    return response;
}, error => {
    if (error.response.status === 401) {
        localStorage.setItem('user', null);
        router.push('/login')
    }
    return error;
});