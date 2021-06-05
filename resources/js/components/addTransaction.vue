<template>
    <div>
        <a href="#" @click="showModal" class="flex items-center mr-4 px-3 py-2 bg-blue-700 rounded-md text-white text-xs font-bold uppercase tracking-tight">
            Add Item
        </a>
        <add-transaction-modal v-show="isModalVisible" @close="closeModal" />
    </div>
</template>

<script>

import addTransactionModal from './addTransactionModal.vue';
export default {
    components: {
        addTransactionModal
    },
    data() {
      return {
        isModalVisible: false,
      };
    },
    methods: {
      showModal() {
        this.isModalVisible = true;
      },
      closeModal() {
        this.isModalVisible = false;
      }
    }

}
</script>
