import Vue from 'vue';
import router from './routes';
import store from './store/index';
import { Form } from 'vform';
import Moment from 'moment';
import VueProgressBar from 'vue-progressbar'
require('./bootstrap');

/* Helpers */
import Notification from './Helpers/Notification';
window.Notification = Notification;

import axios from 'axios';
axios.defaults.withCredentials = true;
axios.defaults.baseURL = 'http://pharmapos.test/'


/* Components */
import { Button, HasError } from 'vform/src/components/bootstrap4';
import App from './components/App';

Vue.use(VueProgressBar, {
    color: 'rgb(69, 194, 3)',
    failedColor: 'red',
    height: '2px'
});

Vue.component(Button.name, Button)
Vue.component(HasError.name, HasError)

Vue.filter('formatteddDate', function (date) {
    return Moment(date).format('MMMM Do YYYY');
});

window.Form = Form;
window.Fire = new Vue();

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

