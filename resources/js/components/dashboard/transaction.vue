<template>
    <div class="flex items-center mb-4 px-4 py-2 shadow-md bg-white rounded-md">
        <div class="flex-grow">
            <div class="font-bold">
                {{ data.label }}
            </div>
            <div class="text-xs text-gray-500">
                {{ formattedDate }}
            </div>
        </div>
        <div class="text-lg font-bold" :class="amountClass">
            {{ data.amount > 0 ? '+ ' : '- ' }}
            ${{ formattedAmount }}.<span class="text-sm">{{ fraction }}</span>
        </div>
    </div>
</template>

<script>
export default {
    name: "transaction",
    props: ['data'],
    computed: {
        formattedDate() {
            const d = new Date(this.data.occurred_at.replace(' ', 'T'))

            return d.toLocaleDateString('en-US', {
                year: 'numeric',
                month: 'long',
                day: 'numeric',
            }) + ' at ' + d.toLocaleTimeString()
        },

        formattedAmount() {
            return Math.abs(this.data.amount).toFixed(0)
        },

        fraction() {
            // I am sad to do this, but don't wanna waste time here :[
            return this.data.amount.toString().split('.')[1]
        },

        amountClass() {
            return this.data.amount > 0 ? 'text-green-500' : ''
        }
    }
}
</script>
