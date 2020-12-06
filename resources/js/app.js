require('./bootstrap');

Vue.component('transaction', () => import('./components/dashboard/transaction'));
Vue.component('transaction-group', () => import('./components/dashboard/transaction-group'));
Vue.component('new-entry', () => import('./components/dashboard/new-entry'));
Vue.component('edit-entry', () => import('./components/dashboard/edit-entry'));
Vue.component('balance', () => import('./components/dashboard/balance'));
Vue.component('modal', require('./components/Modal.vue').default);

const app = new Vue({
    el: '#app',
    data: {
        currentBalance: CURRENT_BALANCE
    },
    methods: {
        updateCurrentBalance() {
            axios.get('/balance').then(response => {
                this.currentBalance = response.data.balance
            })
        }
    }
})
