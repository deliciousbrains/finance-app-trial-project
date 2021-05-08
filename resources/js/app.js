require('./bootstrap');

import Vue from 'vue'
import MoneyValueComponent from '../views/vue-components/MoneyValue'

//Main pages
import App from '../views/app.vue'

Vue.component('money-value', MoneyValueComponent)

const app = new Vue({
    el: '#app',
    components: { App }
});
