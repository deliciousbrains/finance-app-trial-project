<template>
    <div class="my-auto text-right font-bold text-xs uppercase tracking-tight leading-7 text-gray-400">
        Total Balance
        <span class="block text-3xl font-normal text-green-500">
            ${{ formattedAmount }}.<span class="text-xl">{{ fraction }}</span>
        </span>
    </div>
</template>

<script>
export default {
    name: "balance",
    props: {
        value: {
            required: true,
            type: Number
        }
    },
    data() {
        return {
            balance: this.value
        }
    },
    watch: {
        value() {
            this.balance = this.value
        }
    },
    computed: {
        formattedAmount() {
            return Math.abs(this.balance).toFixed(0)
        },

        fraction() {
            return this.balance.toFixed(2).split('.')[1]
        },
    }
}
</script>

<style scoped>

</style>
