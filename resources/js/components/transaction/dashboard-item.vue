<template>
    <div class="group flex flex-col bg-white rounded-lg shadow-md p-4">
        <div class="flex space-x-4">
            <div class="flex flex-col flex-grow">
                <span class="text-lg font-semibold">
                    {{ data.label ? data.label : 'No label'  }}
                    <span v-if="updated" class="text-xs font-bold uppercase bg-green-100 rounded-full text-green-500 px-2 py-1">Updated</span>
                </span>
                <span>{{ formatedPerformedAt }}</span>
            </div>
            <div v-if="!editing" class="flex flex-col justify-center">
                <div class="hidden group-hover:block space-x-4 text-blue-700 uppercase text-sm font-bold underline">
                    <span @click="editing = true">Edit</span>
                    <span>Delete</span>
                </div>
            </div>
            <div class="flex flex-col justify-center font-bold" :class="amountClass">
                {{ formatedAmount }}
            </div>
        </div>
        <div v-if="editing" class="-mx-4 px-4 mt-6 pt-6 border-t">
            <ul class="bg-red-100 border border-red-500 text-red-500 rounded p-2 mb-6 text-xs" v-if="errors.length">
                <li v-for="(error, index) in errors" :key="index">{{ error }}</li>
            </ul>
            <edit-entry-form :data.sync="data"></edit-entry-form>
            <div class="mt-6 -mx-4 p-6 pb-0 border-t flex flex-row-reverse">
                <button class="text-xs uppercase font-semibold px-4 py-2 rounded bg-blue-700 text-white" @click="save">Update Entry</button>
                <button class="mx-2 text-xs uppercase font-semibold px-4 py-2 rounded bg-blue-200 text-gray-500" @click="editing = false">
                    Cancel
                </button>
            </div>
        </div>
    </div>
</template>

<script>
import EditEntryForm from './form'
export default {
    props: ['transaction'],
    components: {
        EditEntryForm,
    },
    data() {
        return {
            editing: false,
            updated: false,
            data: {},
            errors: [],
        }
    },
    mounted() {
        this.data = {
            ...this.transaction,
        }
    },
    methods: {
        save: function () {
            axios.put(route('transactions.update', this.data), this.data)
                .then(res => {
                    this.editing = false
                    this.updated = true
                })
                .catch(err => {
                    if (err.response) {
                        for (const field in err.response.data) {
                            this.errors.push(err.response.data[field][0])
                        }
                    }
                })
        }
    },
    computed: {
        formatedPerformedAt: function () {
            const d = new Date(this.data.performed_at)
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

            return this.data.amount < 0
                ? '- ' + formatter.format(this.data.amount.toString().replace('-', ''))
                : formatter.format(this.data.amount)
        },
        amountClass: function () {
            return this.data.amount < 0
                ? 'text-gray-400'
                : 'text-green-500'
        }
    }
}
</script>