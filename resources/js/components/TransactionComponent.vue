<template>
    <div>
        <div class="mb-12 py-6 bg-gray-800">
            <div class="container mx-auto flex px-8">
                <div class="my-auto text-white flex flex-grow items-center">
                    <h1 class="md:block hidden mr-4 text-2xl font-bold">
                        Your Balance
                    </h1>

                    <div class="flex flex-row">
                        <add-transaction />
                        <a href="#" class="flex items-center mr-4 px-3 py-2 bg-blue-700 rounded-md text-white text-xs font-bold uppercase tracking-tight">
                            Import CSV
                        </a>
                    </div>
                </div>
                <div class="my-auto text-right font-bold text-xs uppercase tracking-tight leading-7 text-gray-400">
                    Total Balance
                    <span class="block text-3xl font-normal text-green-500" v-html="$options.filters.balanceFormat(totalBalance)"></span>
                </div>
            </div>
        </div>
        <div v-if="info">
            <div v-for="trans, key in info" :key="key">
                <div class="mb-8">
                    <div class="flex items-center mb-4">
                        <span class="flex-grow text-gray-500 font-bold text-sm uppercase tracking-tight">{{ trans.date }}</span>
                        <span class="text-lg text-gray-500 font-bold" v-html="$options.filters.balanceFormat(trans.balance)"></span>
                    </div>
                    <div v-for="ind, k in trans.transactions" :key="k">
                        <div>
                            <div class="flex items-center mb-4 px-4 py-2 shadow-md bg-white rounded-md">
                                <div class="flex-grow">
                                    <div class="font-bold">
                                        {{ ind.label }}
                                    </div>
                                    <div class="text-xs text-gray-500">
                                    {{ ind.date }}
                                    </div>
                                </div>
                                <div class="text-lg font-bold" v-html="$options.filters.balanceFormat(ind.value)"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import addTransaction from './addTransaction.vue';

export default ({
    data() {
        return {
            info: null,
            totalBalance: 0
        }
    },
    components: {
        addTransaction
    },
    mounted() {
        axios
            .get('/api/account', {headers: {Authorization: 'Bearer ' + this.$cookies.get("user_auth")}})
            .then(response => {
                // this.totalBalance = _.sumBy(response.data.data.transactions, 'value'); // FE version
                this.totalBalance = response.data.data.balance;
                let result = _(response.data.data.transactions)
                    .groupBy(i => DateTime.fromISO(i.date) .toFormat('DDD'))
                    .map((value, key) => ({date: key, transactions: value, balance: _.sumBy(value, value => Number(value.value))}))
                    .value();
                result = _.orderBy(result, [(d) => new Date(d.date)], ['desc'])
                this.info = result;
            });
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
})
</script>
