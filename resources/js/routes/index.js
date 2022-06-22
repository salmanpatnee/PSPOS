import Vue from 'vue';
import VueRouter from 'vue-router';
import store from '../store/index';
import Login from '../components/Auth/Login';
import Dashboard from '../components/Dashboard';

import Categories from '../components/Categories/index';

import Users from '../components/Users/index';
import User from '../components/Users/create';

import Customers from '../components/Customers/index';
import Customer from '../components/Customers/create';


Vue.use(VueRouter);

const Routes = new VueRouter({
    routes: [
        { path: '/', component: Login, name: 'app' },
        { path: '/login', component: Login, name: 'login', alias: '/' },
        { path: '/dashboard', component: Dashboard, name: 'dashboard', meta: { requiredAuth: true } },

        //Categories
        { path: '/categories', component: Categories, name: 'categories', authorize: ['create-categories'] },

        //Users
        { path: '/users', component: Users, name: 'users.index', meta: { requiresAuth: true, authorize: ['view-users'] } },
        { path: '/users/create', component: User, name: 'users.create', meta: { requiresAuth: true, authorize: ['create-users'] } },
        { path: '/users/edit/:user', component: User, name: 'users.edit', meta: { requiresAuth: true, authorize: ['update-users'] } },

        //Customers
        { path: '/customers', component: Customers, name: 'customers.index', meta: { requiresAuth: true, authorize: ['view-customers'] } },
        { path: '/customers/create', component: Customer, name: 'customers.create', meta: { requiresAuth: true, authorize: ['create-customers'] } },
        { path: '/customers/edit/:user', component: Customer, name: 'customers.edit', meta: { requiresAuth: true, authorize: ['update-customers'] } },
    ],
    mode: 'history'
});

Routes.beforeEach((to, from, next) => {

    const { requiresAuth, authorize } = to.meta;
    const { authenticated } = store.getters;

    if (requiresAuth) {
        if (authenticated) {
            const { permissions } = store.getters.user.data;

            if (authorize) {
                if (!authorize.some(permission => permissions.includes(permission))) {
                    next({ name: 'login' });
                }
            } else {
                next();
            }
            next();
        } else {
            next({ name: 'login' });
        }
    }
    next();
});

/*
Routes.beforeEach((to, from, next) => {
    if (to.matched.some(record => record.meta.requiredAuth)) {
        if (!store.getters.authenticated) {
            next({ name: 'login' })
        } else {
            next();
        }
    }
    next();
});
*/

export default Routes;