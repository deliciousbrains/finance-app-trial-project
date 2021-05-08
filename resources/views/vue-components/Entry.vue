<template>
  <div class="flex items-center mb-4 px-4 py-2 shadow-md bg-white rounded-md">
    <div class="flex-grow">
      <div class="font-bold">
        {{ entry.label }}
      </div>
      <div class="text-xs text-gray-500">
        {{ dayWithTime(entry.date) }}
      </div>
    </div>
    <div class="text-lg font-bold">
      <span v-if="entry.value < 0">-</span>
      <span v-else>+</span>
      <money-value :sum="entry.value" class-name="text-sm"></money-value>
    </div>
  </div>
</template>

<script>
import {DateTime} from "luxon";

export default {
  props: {
    entry: {
      type: Object,
      required: true
    }
  },
  methods: {
    dayWithTime (day) {
      const dayObject = DateTime.fromISO(day).setLocale('en')
      const date = dayObject.toFormat('dd LLLL, y')
      const time = dayObject.toFormat('hh:mm a')
      return `${date} at ${time}`
    }
  }
}
</script>
