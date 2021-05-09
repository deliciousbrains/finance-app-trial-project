<template>
  <!--Modal-->
  <div
      class="fixed w-full h-full top-0 left-0 z-30 flex items-center justify-center"
      v-show="isAdded"
  >
    <div class="absolute w-full h-full bg-gray-900 opacity-50 z-40" @click.prevent></div>
    <div class="bg-white w-1/2 mx-auto rounded shadow-lg z-50 overflow-y-auto">
      <h1 class="md:block hidden mr-4 px-6 py-6 text-2xl font-bold">
        Add Balance Entry
      </h1>
      <entry-form
          :date="dayWithTime()"
          label=""
          :amount="0"
          :errors="errors"
          @input-label="label = $event"
          @input-amount="amount = $event"
          @input-date="date = $event"
      ></entry-form>
      <div class="flex flex-row py-6 px-6">
        <div class="flex-grow"></div>
        <div class="flex flex-row">
          <a
              href="#"
              @click.prevent="stopAdd()"
              class="flex bg-blue-100 text-gray-500 rounded-md font-bold items-center uppercase mr-4 px-6 py-4"
          >Cancel</a>
          <a
              href="#"
              class="flex bg-blue-700 text-white rounded-md font-bold items-center uppercase mr-4 px-6 py-4"
              @click.prevent="saveEntry()"
          >Save Entry</a>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import EntryFormComponent from "./EntryForm"
import DayTimeService from "../vue-services/DayTimeService"
import FormValidatorService from "../vue-services/FormValidatorService"
import HttpService from "../vue-services/HttpService"
import {DateTime} from "luxon";

export default {
  components: {
    entryForm: EntryFormComponent
  },
  data () {
    return {
      isAdded: false,
      label: '',
      date: this.dayWithTime(),
      amount: 0,
      errors: []
    }
  },
  methods: {
    stopAdd () {
      this.isAdded = false
      this.errors = []
    },
    dayWithTime (day) {
      return DayTimeService.dayWithTime(day)
    },
    saveEntry () {
      const formData = {
        label: this.label,
        date: this.date,
        amount: this.amount
      }
      this.errors = FormValidatorService.validateForm(formData)
      if (this.errors.length === 0) {
        formData.date = DayTimeService.getSQLDate(this.date)
        HttpService.makeRequest('post', '/api/entries', formData)
            .then(() => {
              this.$root.$emit('refreshEntries')
              this.isAdded = false
            })
            .catch((error) => {
              console.log(error)
            })
      } else {
        this.label = ''
        this.date = this.dayWithTime()
        this.amount = 0
      }
    }
  },
  mounted () {
    this.$root.$on('openModal', () => {
      this.isAdded = true
    });
  }
}
</script>
