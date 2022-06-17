import Vue from 'vue';
import VueRouter from 'vue-router';
import store from './store/index';
import Login from './components/Auth/Login';
import Dashboard from './components/DashboardComponent';
import Categorie from './components/CategoriesComponent';


Vue.use(VueRouter);

const Routes = new VueRouter({
    routes: [
        { path: '/', component: Login, name: 'app' },
        { path: '/login', component: Login, name: 'login', alias: '/' },
        { path: '/dashboard', component: Dashboard, name: 'dashboard', meta: { requiredAuth: true } },
        { path: '/categories', component: Categorie, name: 'categories' },
    ],
    mode: 'history'
});

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


export default Routes;