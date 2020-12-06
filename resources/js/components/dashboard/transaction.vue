<template>
    <div>
        <div class="mb-4 shadow-md bg-white rounded-md group">
            <div class="flex items-center mb-2 px-4 py-2">
                <div class="flex-grow">
                    <div class="font-bold">
                        {{ transaction.label }}
                    </div>
                    <div class="text-xs text-gray-500">
                        {{ formattedDate }}
                    </div>
                </div>

                <div class="xl:flex-col mr-10">
                    <a href="#" @click.prevent="editing = true" class="pr-3 underline text-white uppercase md:text-sm group-hover:text-blue-700 font-bold">Edit</a>
                    <a href="#" @click.prevent="deleteItem" class="pr-2 underline text-white uppercase md:text-sm group-hover:text-red-700 font-bold">Delete</a>
                </div>

                <div class="text-lg font-bold" :class="amountClass">
                    {{ transaction.amount > 0 ? '+ ' : '- ' }}
                    ${{ formattedAmount }}.<span class="text-sm">{{ fraction }}</span>
                </div>
            </div>

            <hr v-if="editing" />

            <edit-entry v-if="editing" :transaction="transaction" @cancel="editing = false" @edited="editing = false"></edit-entry>
        </div>
    </div>
</template>

<script>
export default {
    name: "transaction",
    props: {
        transaction: {
            required: true,
            type: Object
        }
    },
    data() {
        return {
            editing: false
        }
    },
    methods: {
        deleteItem() {
            if (confirm('Are you sure you want to delete this?') === false) {
                return;
            }

            axios.delete('/transaction/' + this.transaction.id)
                .then(response => {
                    this.$emit('remove', this.transaction.id)
                })
        },
    },
    computed: {
        formattedDate() {
            const date = new Date(this.transaction.occurred_at.replace(' ', 'T'))

            return date.toLocaleDateString('en-US', {
                year: 'numeric',
                month: 'long',
                day: 'numeric',
            }) + ' at ' + date.toLocaleTimeString()
        },

        formattedAmount() {
            return Math.abs(this.transaction.amount).toFixed(0)
        },

        fraction() {
            // I am sad to do this, but don't wanna waste time here :[
            return this.transaction.amount.toString().split('.')[1]
        },

        amountClass() {
            return this.transaction.amount > 0 ? 'text-green-500' : 'text-gray-500'
        }
    }
}
</script>
