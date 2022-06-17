import Vue from 'vue';
import router from './routes';
import store from './store/index';
import { Form } from 'vform';
import Moment from 'moment';
import VueProgressBar from 'vue-progressbar'
import Swal from 'sweetalert2';
require('./bootstrap');

import axios from 'axios';
axios.defaults.withCredentials = true;
axios.defaults.baseURL = 'http://pharmapos.test/'


/* Components */
import { Button, HasError, AlertError, AlertErrors, AlertSuccess } from 'vform/src/components/bootstrap4';
import App from './components/App';

Vue.use(VueProgressBar, {
    color: 'rgb(69, 194, 3)',
    failedColor: 'red',
    height: '2px'
});

Vue.component(Button.name, Button)
Vue.component(HasError.name, HasError)
Vue.component(AlertError.name, AlertError)
Vue.component(AlertErrors.name, AlertErrors)
Vue.component(AlertSuccess.name, AlertSuccess)

Vue.filter('formatteddDate', function (date) {
    return Moment(date).format('MMMM Do YYYY');
});

window.Form = Form;
window.Swal = Swal;
window.Fire = new Vue();

const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true,
    didOpen: (toast) => {
        toast.addEventListener('mouseenter', Swal.stopTimer)
        toast.addEventListener('mouseleave', Swal.resumeTimer)
    }
});

window.Toast = Toast;

store.dispatch('getUser').then(() => {
    const app = new Vue({
        el: '#app',
        components: {
            App
        },
        router,
        store
    });
});

