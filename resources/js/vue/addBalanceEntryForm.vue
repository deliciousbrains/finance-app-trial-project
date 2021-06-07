<template>
    <div>
        <a href="#" @click="toggleModal" class="flex items-center mr-4 px-3 py-5 bg-blue-700 rounded-md text-white text-xs font-bold uppercase tracking-tight">
            <img src="/images/add.svg" /><span class="ml-3">Add Item</span>
        </a>

        <add-transaction-modal v-show="showModal" @close="toggleModal" />
    </div>
</template>

<script>
import addTransactionModal from './addBalanceModal';

export default {
  components: {
        addTransactionModal
    },
  data() {
    return {
      showModal: false
    }
  },
  methods: {
    toggleModal: function(){
      this.showModal = !this.showModal;
    }
  }
}
</script>
