<template>
  <div>
    <div class="container mx-auto px-8">
      <div class="mb-8" v-for="day in days" :key="day.day">
        <div class="flex items-center mb-4">
          <span
              v-if="day.isToday"
              class="flex-grow text-gray-500 font-bold text-sm uppercase tracking-tight"
          >Today</span>
          <span
              v-else-if="day.isYesterday"
              class="flex-grow text-gray-500 font-bold text-sm uppercase tracking-tight"
          >Yesterday</span>
          <span
              v-else
              class="flex-grow text-gray-500 font-bold text-sm uppercase tracking-tight"
          >{{ dayWithWeekday(day.day) }}</span>
          <span class="text-lg text-gray-500 font-bold">
            <span v-if="day.sum < 0">-</span>
            <span v-else>+</span>
            <money-value :sum="day.sum" class-name="text-sm"></money-value>
          </span>
        </div>

        <div>
          <entry
              v-for="entry in day.entries"
              :key="entry.label"
              :entry="entry"
          ></entry>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { DateTime } from "luxon"
import EntryComponent from './Entry'

export default {
  components: {
    entry: EntryComponent
  },
  data () {
    return {
      days: [
        {
          day: '2020-05-20',
          isToday: true,
          isYesterday: false,
          sum: -50,
          entries: [
            {
              label: 'Groceries',
              value: -60,
              date: '2020-05-20 22:55:00'
            },
            {
              label: 'Lottery Win',
              value: 10,
              date: '2020-05-20 09:05:00'
            }
          ]
        },
        {
          day: '2020-05-19',
          isToday: false,
          isYesterday: true,
          sum: -500,
          entries: [
            {
              label: 'Car Insurance',
              value: -500,
              date: '2020-05-19 08:00:00'
            }
          ]
        },
        {
          day: '2020-05-11',
          isToday: false,
          isYesterday: false,
          sum: 3000,
          entries: [
            {
              label: 'Opening Balance',
              value: 3000,
              date: '2020-05-11 10:00:00'
            }
          ]
        }
      ]
    }
  },
  methods: {
    dayWithWeekday (day) {
      const dayObject = DateTime.fromSQL(day).setLocale('en')
      return dayObject.toFormat('ccc, d LLLL')
    }
  }
}
</script>
