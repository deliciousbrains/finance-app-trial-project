require('./bootstrap');

Vue.component('transaction-dashboard-item', () => import('./components/transaction/dashboard-item'));

const app = new Vue({
    el: '#app',
})
