<template>
    <form class="flex space-x-4">
        <div class="w-1/3 flex flex-col">
            <label for="label" class="text-xs uppercase font-bold text-gray-600">Label</label>
            <input @keyup="update" v-model="data.label" type="text" id="label" class="border rounded text-sm p-2" />
        </div>
        <div class="w-1/3 flex flex-col">
            <label for="performed_at" class="text-xs uppercase font-bold text-gray-600">Date</label>
            <input @keyup="update" v-model="data.performed_at" type="text" id="performed_at" class="border rounded text-sm p-2" />
        </div>
        <div class="w-1/3 flex flex-col">
            <label for="amount" class="text-xs uppercase font-bold text-gray-600">Amount</label>
            <input @keyup="update" v-model="data.amount" type="text" id="amount" class="border rounded text-sm p-2" />
        </div>
    </form>
</template>

<script>
export default {
    props: ['data'],
    methods: {
        update: function () {
            this.$emit('update:data', {
                ...this.data
            })
        }
    }
}
</script>