require('./bootstrap');

Vue.component('modal', () => import('./components/modal'));
Vue.component('transaction-add-entry', () => import('./components/transaction/add-entry'));
Vue.component('transaction-dashboard-item', () => import('./components/transaction/dashboard-item'));

const app = new Vue({
    el: '#app',
})
