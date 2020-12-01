<template>
    <div class="group flex bg-white rounded-lg shadow-md p-4 space-x-4">
        <div class="flex flex-col flex-grow">
            <span class="text-lg font-semibold">{{ transaction.label }}</span>
            <span>{{ formatedPerformedAt }}</span>
        </div>
        <div class="flex flex-col justify-center">
            <div class="hidden group-hover:block space-x-4 text-blue-700 uppercase text-sm font-bold underline">
                <span>Edit</span>
                <span>Delete</span>
            </div>
        </div>
        <div class="flex flex-col justify-center font-bold" :class="amountClass">
            {{ formatedAmount }}
        </div>
    </div>
</template>

<script>
export default {
    props: ['transaction'],
    computed: {
        formatedPerformedAt: function () {
            // This is a bit of a quick hack to make this date work with JS
            // built in format, buuuut you can't deny it works without going
            // down the momentjs rabbit hole or something.
            const d = new Date(this.transaction.performed_at.replace(' ', 'T'))
            return d.toLocaleDateString('en-US', {
                year: 'numeric',
                month: 'long',
                day: 'numeric',
            }) + ' at ' + d.toLocaleTimeString()
        },
        formatedAmount: function () {
            // Cheers: https://stackoverflow.com/a/16233919
            const formatter = new Intl.NumberFormat('en-US', {
                style: 'currency',
                currency: 'USD',
            });

            return this.transaction.amount < 0
                ? '- ' + formatter.format(this.transaction.amount.toString().replace('-', ''))
                : formatter.format(this.transaction.amount)
        },
        amountClass: function () {
            return this.transaction.amount < 0
                ? 'text-gray-400'
                : 'text-green-500'
        }
    }
}
</script>