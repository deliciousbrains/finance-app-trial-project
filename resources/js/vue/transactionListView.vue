<template>
    <div>
        <div v-for="(item, index) in items" :key="index">
            <transaction-item :item="item" v-on:itemchanged="$emit('reloadList')"></transaction-item>
        </div>
    </div>
</template>

<script>

import TransactionItem from './transactionItem.vue';
export default {
    props: ['items'],
    components: {
        TransactionItem
    }
};
</script>
