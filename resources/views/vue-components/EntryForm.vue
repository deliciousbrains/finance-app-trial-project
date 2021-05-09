<template>
  <div class="flex flex-row py-10 border-t border-b px-4">
    <div class="flex flex-auto flex-col px-3 w-2/5">
      <label :for="'label' + entry.id" class="text-gray-700 font-bold uppercase pb-2">Label</label>
      <input
          :id="'label' + entry.id"
          type="text"
          :value="entry.label"
          class="shadow appearance-none border rounded px-3 py-3 mb-3"
      />
    </div>
    <div class="flex flex-auto flex-col px-3 w-2/5">
      <label :for="'date' + entry.id" class="text-gray-700 font-bold uppercase pb-2">Date</label>
      <input
          :id="'date' + entry.id"
          type="text"
          :value="dayWithTime(entry.date)"
          class="shadow appearance-none border rounded px-3 py-3 mb-3"
      />
    </div>
    <div class="flex flex-auto flex-col px-3 w-1/5">
      <label :for="'value-' + entry.id" class="text-gray-700 font-bold uppercase pb-2">Amount</label>
      <div class="relative rounded border shadow px-3 py-3 mb-3">
        <div class="absolute inset-y-0 left-0 px-3 flex items-center pointer-events-none">
          <span class="text-gray-500 sm:text-sm">$</span>
        </div>
        <input
            :id="'value-' + entry.id"
            type="text"
            :value="entryValue"
            class="appearance-none px-4 w-4/5"
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
import DayTimeService from "../vue-services/DayTimeService";

export default {
  props: {
    entry: {
      type: Object,
      default: function () {
        return {
          id: 0,
          label: '',
          value: 0,
          date: ''
        }
      }
    }
  },
  computed: {
    entryValue () {
      if (this.entry.value !== 0) {
        return this.entry.value.toFixed(2)
      }
      return ''
    }
  },
  methods: {
    dayWithTime (day) {
      if (day) {
        return DayTimeService.dayWithTime(day)
      }
      return ''
    }
  }
}
</script>
