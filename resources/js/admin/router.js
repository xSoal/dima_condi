import Vue from 'vue'
import VueRouter from 'vue-router'

import Dashboard from './components/Dashboard/Dashboard';
import Login from "./components/Login/Login";
import Register from './components/Register/Register'
import Pages from "./components/Dashboard/Pages/Pages";

Vue.use(VueRouter);


const routes = [
    {
        path: '/admin',
        component: Dashboard,
        name: 'dashboard',
        meta: {
            layout: "dashboard",
            needAuth: true,
            dashboardHeaderText: 'Админка'
        }
    },
    {
        path: '/admin/pages',
        component: Pages,
        name: 'pages',
        meta: {
            layout: "dashboard",
            needAuth: true,
            dashboardHeaderText: 'Страницы'
        }
    },
    {
        path: '/admin/login',
        name: 'login',
        component: Login,
        meta: {
            layout: "login"
        }
    },
    {
        path: '/admin/register',
        name: 'register',
        component: Register,
        meta: {
            layout: "login"
        }
    },

];

const router = new VueRouter({
    routes,
    mode: 'history'
});


router.beforeEach((to, from, next) => {

    const API = Vue.prototype.$API;

    const isAuth = API.isAuth();

    const needAuth = to.matched.some(route => route.meta.needAuth);

    if( !isAuth && needAuth ){
        next('admin/login');
    } else {
        next();
    }


});


export default router;
