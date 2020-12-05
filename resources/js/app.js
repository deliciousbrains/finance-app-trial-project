require('./bootstrap');

Vue.component('transaction', () => import('./components/dashboard/transaction'));

const app = new Vue({
    el: '#app',
})
