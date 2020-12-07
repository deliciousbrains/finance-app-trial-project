<template>
    <div class="mb-8" v-if="transactions.length">
        <div class="flex items-center mb-4">
            <span class="flex-grow text-gray-500 font-bold text-sm uppercase tracking-tight">{{ date }}</span>
            <span class="text-lg text-gray-500 font-bold" :class="amountClass">
                {{ this.total > 0 ? '+ ' : '- ' }}
                ${{ formattedAmount }}.<span class="text-sm">{{ fraction }}</span>
            </span>
        </div>
        <transaction v-for="transaction in transactions" :transaction='transaction' :key="transaction.id" @remove="removeTransaction" @update="updateTransaction"></transaction>
    </div>
</template>

<script>
export default {
    name: "transaction-group",
    props: {
        date: {
            required: true,
            type: String
        },
        data: {
            required: true,
            type: Array
        }
    },
    data() {
        return {
            transactions: this.data
        }
    },
    watch: {
        data() {
            this.transactions = this.data
        }
    },
    methods: {
        removeTransaction: function(id) {
            this.transactions.forEach(transaction => {
                if (transaction.id === id) {
                    this.transactions.splice(this.transactions.indexOf(transaction), 1)
                    this.$emit('remove')
                }
            })
        },
        updateTransaction: function() {
            this.$emit('update')
        }
    },
    computed: {
        total() {
            let total = 0

            this.transactions.forEach(transaction => {
                total += parseFloat(transaction.amount)
            })

            return total
        },

        formattedAmount() {
            return Math.abs(this.total).toFixed(0)
        },

        fraction() {
            // I am sad to do this, but don't wanna waste time here :[
            return this.total.toFixed(2).toString().split('.')[1]
        },

        amountClass() {
            return this.total > 0 ? 'text-green-500' : 'text-gray-500'
        }
    }
}
</script>
