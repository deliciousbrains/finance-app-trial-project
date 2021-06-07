<template>
    <div>
        <div class="mb-12 py-6 bg-gray-800">
            <div class="container mx-auto flex px-8">
                <div class="my-auto text-white flex flex-grow items-center">
                    <h1 class="md:block hidden mr-4 text-2xl font-bold">
                        Your Balance
                    </h1>

                    <div class="flex flex-row">

                    <div>
                        <a href="#" @click="toggleModal" class="flex items-center mr-4 px-3 py-5 bg-blue-700 rounded-md text-white text-xs font-bold uppercase tracking-tight">
                            <img src="/images/add.svg" /><span class="ml-3">Add Item</span>
                        </a>
                    </div>

                        <a href="#" class="flex items-center mr-4 px-3 py-2 bg-blue-700 rounded-md text-white text-xs font-bold uppercase tracking-tight">
                            <img src="/images/import.svg" width="25px"/><span>Import CSV</span>
                        </a>
                    </div>
                </div>
                <div class="my-auto text-right font-bold text-xs uppercase tracking-tight leading-7 text-gray-400">
                    Total Balance
                    <span class="block text-3xl font-normal text-green-500" v-html="$options.filters.balanceFormat(totalBalance)"></span>
                </div>
            </div>
        </div>

        <add-balance-modal :accountId="accountId" v-show="showModal" @close="toggleModal" v-on:reloadList="fetchList()" />
        <transaction-list-view :items="items" v-on:reloadList="fetchList()" />
    </div>
</template>

<script>
import addBalanceModal from './addBalanceModal';
import TransactionListView from './transactionListView';


export default {
    components: { addBalanceModal, TransactionListView },
    data() {
        return {
            accountId: null,
            showModal: false,
            items: [],
            totalBalance: 0
        }
    },
    created() {
        this.fetchList();
    },
    methods: {
        fetchList() {
            axios
            .get('/api/account', {headers: {Authorization: 'Bearer ' + this.$cookies.get("user_auth")}})
            .then(response => {
                this.accountId = response.data.data.account_id;
                this.totalBalance = response.data.data.balance;
                let result = _(response.data.data.transactions)
                    .groupBy(i => DateTime.fromISO(i.date) .toFormat('DDD'))
                    .map((value, key) => ({date: key, transactions: value, balance: _.sumBy(value, value => Number(value.value))}))
                    .value();
                result = _.orderBy(result, [(d) => new Date(d.date)], ['desc'])
                this.items = result;
            });
        },
        toggleModal: function(){
            this.showModal = !this.showModal;
        }
    },
    filters: {
        balanceFormat(value) {
            let formatter = new Intl.NumberFormat('en-GB', {
                style: 'currency',
                currency: 'GBP',
                minimumFractionDigits: 2
            });

            let numberArr = formatter.format(value).split('.');
            return numberArr[0] + ".<span class='text-sm'>" + numberArr[1] + "</span>";
        }
    }
};
</script>
