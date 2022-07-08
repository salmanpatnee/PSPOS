import Vue from 'vue';
import router from './routes/index';
import store from './store/index';
import { Form } from 'vform';
import Moment from 'moment';
import VueProgressBar from 'vue-progressbar'
import Auth from './mixins/Auth';

require('./bootstrap');

/* Helpers */
import Notification from './Helpers/Notification';
window.Notification = Notification;

import axios from 'axios';
axios.defaults.withCredentials = true;
axios.defaults.baseURL = process.env.APP_URL;


/* Components */
import { Button, HasError, AlertErrors } from 'vform/src/components/bootstrap4';
import App from './components/App';


Vue.use(VueProgressBar, {
    color: 'rgb(69, 194, 3)',
    failedColor: 'red',
    height: '2px'
});

Vue.component(Button.name, Button)
Vue.component(HasError.name, HasError)
Vue.component(AlertErrors.name, AlertErrors)

Vue.component('paginate-dropdown', require('./components/Common/PaginateDropdown.vue').default);
Vue.component('pagination-info', require('./components/Common/PaginationInfo.vue').default);
Vue.component('search', require('./components/Common/Search.vue').default);
Vue.component('action-button', require('./components/Common/ActionButton.vue').default);
Vue.component('edit-button', require('./components/Common/EditButton.vue').default);
Vue.component('delete-button', require('./components/Common/DeleteButton.vue').default);
Vue.component('table-header', require('./components/Common/TableHeader.vue').default);
Vue.component('panel', require('./components/Common/Panel.vue').default);


Vue.filter('formatteddDate', function (date) {
    return Moment(date).format('MMMM Do YYYY');
});

window.Form = Form;
window.Fire = new Vue();

Vue.mixin(Auth);

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

