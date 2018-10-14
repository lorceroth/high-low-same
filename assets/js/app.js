import Vue from 'vue';
import router from './router';
import store from './store';
import App from './components/App.vue';

require('./components');

new Vue({
    el: '#app',
    router,
    store,
    render: create => create(App),
});
