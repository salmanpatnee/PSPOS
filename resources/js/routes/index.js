import Vue from 'vue';
import VueRouter from 'vue-router';
import store from '../store/index';
import Login from '../components/Auth/Login';
import Dashboard from '../components/Dashboard';
import Settings from '../components/Business/index';

import Locations from '../components/Locations/index';
import Location from '../components/Locations/create';

import Categories from '../components/Categories/index';

import Users from '../components/Users/index';
import User from '../components/Users/create';

import Customers from '../components/Customers/index';
import Customer from '../components/Customers/create';

import Suppliers from '../components/Suppliers/index';
import Supplier from '../components/Suppliers/create';


Vue.use(VueRouter);

const Routes = new VueRouter({
    routes: [
        { path: '/', component: Login, name: 'app' },
        { path: '/login', component: Login, name: 'login', alias: '/' },
        { path: '/dashboard', component: Dashboard, name: 'dashboard', meta: { requiresAuth: true } },

        { path: '/settings', component: Settings, name: 'settings.index', meta: { requiresAuth: true, authorize: ['view-settings'] } },

        //Locations/Branches
        { path: '/locations', component: Locations, name: 'locations.index', meta: { requiresAuth: true, authorize: ['view-locations'] } },
        { path: '/locations/create', component: Location, name: 'locations.create', meta: { requiresAuth: true, authorize: ['create-locations'] } },
        { path: '/locations/edit/:location', component: Location, name: 'locations.edit', meta: { requiresAuth: true, authorize: ['update-locations'] } },

        //Categories
        { path: '/categories', component: Categories, name: 'categories', authorize: ['create-categories'] },

        //Users
        { path: '/users', component: Users, name: 'users.index', meta: { requiresAuth: true, authorize: ['view-users'] } },
        { path: '/users/create', component: User, name: 'users.create', meta: { requiresAuth: true, authorize: ['create-users'] } },
        { path: '/users/edit/:user', component: User, name: 'users.edit', meta: { requiresAuth: true, authorize: ['update-users'] } },

        //Customers
        { path: '/customers', component: Customers, name: 'customers.index', meta: { requiresAuth: true, authorize: ['view-customers'] } },
        { path: '/customers/create', component: Customer, name: 'customers.create', meta: { requiresAuth: true, authorize: ['create-customers'] } },
        { path: '/customers/edit/:customer', component: Customer, name: 'customers.edit', meta: { requiresAuth: true, authorize: ['update-customers'] } },

        //Suppliers
        { path: '/suppliers', component: Suppliers, name: 'suppliers.index', meta: { requiresAuth: true, authorize: ['view-suppliers'] } },
        { path: '/suppliers/create', component: Supplier, name: 'suppliers.create', meta: { requiresAuth: true, authorize: ['create-suppliers'] } },
        { path: '/suppliers/edit/:supplier', component: Supplier, name: 'suppliers.edit', meta: { requiresAuth: true, authorize: ['update-suppliers'] } },
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

export default Routes;