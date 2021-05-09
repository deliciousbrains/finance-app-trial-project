<template>
  <div class="flex flex-row py-10 border-t border-b px-4">
    <div class="flex flex-auto flex-col px-3 w-2/5">
      <label :for="'label-' + id" class="text-gray-700 font-bold uppercase pb-2">Label</label>
      <input
          :id="'label-' + id"
          type="text"
          :value="label"
          class="shadow appearance-none border rounded px-3 py-3 mb-3"
          @change="$emit('input-label', $event.target.value)"
      />
    </div>
    <div class="flex flex-auto flex-col px-3 w-2/5">
      <label :for="'date-' + id" class="text-gray-700 font-bold uppercase pb-2">Date</label>
      <input
          :id="'date-' + id"
          type="text"
          :value="date"
          class="shadow appearance-none border rounded px-3 py-3 mb-3"
          @change="$emit('input-date', $event.target.value)"
      />
    </div>
    <div class="flex flex-auto flex-col px-3 w-1/5">
      <label :for="'value-' + id" class="text-gray-700 font-bold uppercase pb-2">Amount</label>
      <div class="relative rounded border shadow px-3 py-3 mb-3">
        <div class="absolute inset-y-0 left-0 px-3 flex items-center pointer-events-none">
          <span class="text-gray-500 sm:text-sm">$</span>
        </div>
        <input
            :id="'value-' + id"
            type="text"
            :value="entryValue"
            class="appearance-none px-4 w-4/5"
            @change="$emit('input-amount', $event.target.value)"
        />
      </div>
    </div>
  </div>
</template>

<style>
input:focus-visible {
  outline-width: 0;
}
</style>

<script>
export default {
  props: {
    id: {
      type: Number,
      default: 0
    },
    label: {
      type: String,
      required: true
    },
    amount: {
      type: Number,
      required: true
    },
    date: {
      type: String,
      required: true
    }
  },
  computed: {
    entryValue () {
      if (this.amount !== 0) {
        return this.amount.toFixed(2)
      }
      return ''
    }
  }
}
</script>
