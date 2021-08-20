import Vue from 'vue'
import VueRouter from 'vue-router'

import Dashboard from './components/Dashboard/Dashboard';
import Login from "./components/Login/Login";
import Register from './components/Register/Register'
import Pages from "./components/Dashboard/Pages/Pages";
import Files from "./components/Dashboard/Files/Files";
import Service__Categories from "./components/Dashboard/Pages/Service__Categories";
import Services from "./components/Dashboard/Pages/Services";
import Features from "./components/Dashboard/Features/Features";
import Users from "./components/Dashboard/Users/Users";

Vue.use(VueRouter);


const routes = [
    {
        path: '/admin',
        component: Dashboard,
        name: 'dashboard',
        meta: {
            layout: "dashboard",
            needAuth: true,
            dashboardHeaderText: 'Админка Главная'
        }
    },
    {
        path: '/admin/pages',
        component: Pages,
        name: 'pages',
        meta: {
            layout: "dashboard",
            needAuth: true,
            dashboardHeaderText: 'Категории услуг'
        },
        children: [
            {
                path: ":id",
                component: Service__Categories,

                meta: {
                    layout: "dashboard",
                    needAuth: true,
                    dashboardHeaderText: 'Услуги'
                },
                children: [
                    {
                        path: ":serviceId",
                        component: Services,

                        meta: {
                            layout: "dashboard",
                            needAuth: true,
                            dashboardHeaderText: 'Данные услуги'
                        }
                    }
                ]
            }
        ]
    },
    {
        path: '/admin/files',
        component: Files,
        name: 'files',
        meta: {
            layout: "dashboard",
            needAuth: true,
            dashboardHeaderText: 'Загрузчик файлов'
        },
    },
    {
        path: '/admin/features',
        component: Features,
        name: 'features',
        meta: {
            layout: "dashboard",
            needAuth: true,
            dashboardHeaderText: 'Наши приемущества'
        },
    },
    {
        path: '/admin/users',
        component: Users,
        name: 'users',
        meta: {
            layout: "dashboard",
            needAuth: true,
            dashboardHeaderText: "Пользователт админки"
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
        next('/admin/login');
    } else {
        next();
    }


});


export default router;
