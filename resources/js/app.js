require('./bootstrap');

Vue.component('transaction', () => import('./components/dashboard/transaction'));
Vue.component('new-entry', () => import('./components/dashboard/new-entry'));
Vue.component('modal', require('./components/Modal.vue').default);

const app = new Vue({
    el: '#app'
})
