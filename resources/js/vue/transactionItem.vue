<template>
    <div class="mb-8">
        <div class="flex items-center mb-4">
            <span class="flex-grow text-gray-500 font-bold text-sm uppercase tracking-tight">{{ item.date }}</span>
            <span class="text-lg text-gray-500 font-bold" v-html="$options.filters.balanceFormat(item.balance)"></span>
        </div>
        <div v-for="ind, k in item.transactions" :key="k">
            <div @mouseover="hoverStateIndex=k" @mouseleave="hoverStateIndex=null" class="cursor-pointer">
                <div class="flex items-center mb-4 px-4 py-2 shadow-md bg-white rounded-md">
                    <div class="flex-grow">
                        <div class="font-bold">
                            {{ ind.label }}
                        </div>
                        <div class="text-xs text-gray-500">
                            {{ ind.date }}
                        </div>
                    </div>
                    <div class="flex-shrink mr-20">
                        <div v-if="hoverStateIndex === k" class="">
                            <span @click="showEditForm(k)" class="px-5 text-blue-500 font-bold text-xs cursor-pointer uppercase">Edit</span>
                            <span @click="deleteTransaction(ind.id)" class="py-3 text-blue-500 font-bold text-xs cursor-pointer uppercase">Delete</span>
                        </div>
                    </div>
                    <div class="text-lg font-bold" v-html="$options.filters.balanceFormat(ind.value)"></div>
                </div>
            </div>
            <div v-if="formOpen">
                <edit-transaction-form :trans="item.transactions" :index="index" v-on:close="hideEditForm()" v-on:itemupdated="$emit('itemchanged')" />
            </div>
        </div>
    </div>
</template>

<script>
import editTransactionForm from './editTransactionForm.vue';
export default {
  components: { editTransactionForm },

    props: ['item'],
    data() {
        return {
            index: 0,
            hoverStateIndex: null,
            formOpen: false,
        };
    },
    methods: {
        showEditForm(index) {
            this.index = index;
            this.formOpen = true;
        },
        hideEditForm() {
            this.formOpen = false;
        },

        deleteTransaction(transactionId) {
            axios
            .delete('/api/transactions/' + transactionId, {headers: {Authorization: 'Bearer ' + this.$cookies.get("user_auth")}})
            .then(response => {
                this.$emit('itemchanged');
            });
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
