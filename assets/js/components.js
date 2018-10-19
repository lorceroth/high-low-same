import Vue from 'vue';
import Button from './components/Button.vue';
import ButtonGroup from './components/ButtonGroup.vue';
import Card from './components/Card.vue';
import Loader from './components/Loader.vue';
import Header from './partials/Header.vue';

// Prefix components with "c" to prevent the components
// to conflict with native elements, e.g. button.

Vue.component('c-button', Button);
Vue.component('c-button-group', ButtonGroup);
Vue.component('c-card', Card);
Vue.component('c-loader', Loader);
Vue.component('c-header', Header);
