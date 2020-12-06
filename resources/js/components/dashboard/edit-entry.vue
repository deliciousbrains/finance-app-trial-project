<template>
    <div class="px-4 py-2 mt-5">
        <div class="grid grid-cols-9 gap-6 mb-5">
            <div class="col-span-6 sm:col-span-4">
                <label for="label" class="block text-sm font-medium text-gray-700 uppercase">Label</label>
                <input v-model="transaction.label" type="text" name="label" id="label" autocomplete="label" required="required" class="mt-1 text-black focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border border-gray-300 rounded-md">
            </div>

            <div class="col-span-6 sm:col-span-3">
                <label for="occurred_at" class="block text-sm font-medium text-gray-700 uppercase">Date</label>
                <datetime :type="'datetime'" :hidden-name="'occurred_at'" v-model="transaction.occurred_at" :required="true" :use12-hour="true" :input-class="'mt-1 text-black focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border border-gray-300 rounded-md'"></datetime>
            </div>

            <div class="col-span-6 sm:col-span-2">
                <label for="amount" class="block text-sm font-medium text-gray-700 uppercase">Amount</label>
                <input v-model="transaction.amount" type="text" name="amount" id="amount" autocomplete="amount"  required="required" class="mt-1 text-black focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border border-gray-300 rounded-md">
            </div>
        </div>

        <div class="py-3 sm:flex sm:flex-row-reverse">
            <button type="submit" @click.prevent="updateTransaction" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-600 text-base font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:ml-3 sm:w-auto sm:text-sm">
                Update Entry
            </button>
            <button type="button" @click.prevent="$emit('cancel')" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                Cancel
            </button>
        </div>
    </div>
</template>

<script>
export default {
    name: "edit-entry",
    props: {
        transaction: {
            required: true,
            type: Object
        }
    },
    methods: {
        updateTransaction: function() {
            axios.patch('/transaction/' + this.transaction.id, {
                'label': this.transaction.label,
                'amount': this.transaction.amount,
                'occurred_at': this.transaction.occurred_at
            }).then(response => {
                this.$emit('edited')
            })
        }
    }
}
</script>

<style scoped>

</style>
