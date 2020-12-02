require('./bootstrap');

Vue.component('modal', () => import('./components/modal'));
Vue.component('transaction-add-entry', () => import('./components/transaction/add-entry'));
Vue.component('transaction-dashboard-item', () => import('./components/transaction/dashboard-item'));
Vue.component('transaction-form', () => import('./components/transaction/form'));

Vue.mixin({ methods: { route }});

const app = new Vue({
    el: '#app',
})
