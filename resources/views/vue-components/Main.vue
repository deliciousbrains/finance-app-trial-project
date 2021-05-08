<template>
  <div>
    <div class="container mx-auto px-8">
      <div class="mb-8" v-for="day in days" :key="day.day">
        <div class="flex items-center mb-4">
          <span
              v-if="day.is_today"
              class="flex-grow text-gray-500 font-bold text-sm uppercase tracking-tight"
          >Today</span>
          <span
              v-else-if="day.is_yesterday"
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
import Http from "../vue-services/HttpService";

export default {
  components: {
    entry: EntryComponent
  },
  data () {
    return {
      days: []
    }
  },
  methods: {
    dayWithWeekday (day) {
      const dayObject = DateTime.fromISO(day).setLocale('en')
      return dayObject.toFormat('ccc, d LLLL')
    }
  },
  mounted () {
    Http.makeRequest('get', '/api/entries')
        .then((response) => {
          this.days = response.data
        })
        .catch((error) => {
          console.log(error)
        })
  }
}
</script>
