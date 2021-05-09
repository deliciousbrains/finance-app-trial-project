<template>
  <div class="mb-4 py-2 shadow-md bg-white rounded-md">
    <div
        class="flex flex-row items-center mb-4 px-4"
        @mouseover="activate()"
        @mouseout="deactivate()"
    >
      <div class="flex-grow">
        <div class="font-bold">
          {{ entry.label }}
        </div>
        <div class="text-xs text-gray-500">
          {{ dayWithTime(entry.date) }}
        </div>
      </div>
      <div v-show="isActive" class="uppercase flex flex-row">
        <a
            class="flex underline hover:no-underline text-blue-700 mr-4 font-bold"
            href="#"
            @click="startEdit()"
        >Edit</a>
        <a
            class="flex underline hover:no-underline text-blue-700 mr-4 font-bold"
            href="#"
            @click="deleteEntry()"
        >Delete</a>
      </div>
      <div class="text-lg font-bold">
        <span v-if="entry.value < 0">-</span>
        <span v-else>+</span>
        <money-value :sum="entry.value" class-name="text-sm"></money-value>
      </div>
    </div>
    <div v-show="isEdited">
      <entry-form
          :id="entry.id"
          :label="label"
          :amount="amount"
          :date="date"
          @input-label="label = $event"
          @input-amount="amount = $event"
          @input-date="date = $event"
      ></entry-form>
      <div class="flex flex-row py-6 px-4">
        <div class="flex-grow"></div>
        <div class="flex flex-row">
          <a
              href="#"
              @click="stopEdit()"
              class="flex bg-blue-100 text-gray-500 rounded-md font-bold items-center uppercase mr-4 px-6 py-4"
          >Cancel</a>
          <a
              href="#"
              class="flex bg-blue-700 text-white rounded-md font-bold items-center uppercase mr-4 px-6 py-4"
              @click="updateEntry()"
          >Update Entry</a>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import DayTimeService from "../vue-services/DayTimeService"
import EntryFormComponent from './EntryForm'
import HttpService from "../vue-services/HttpService"
import FormValidatorService from "../vue-services/FormValidatorService";

export default {
  components: {
    entryForm: EntryFormComponent
  },
  props: {
    entry: {
      type: Object,
      required: true
    }
  },
  data () {
    return {
      isActive: false,
      isEdited: false,
      label: this.entry.label,
      amount: this.entry.value,
      date: this.dayWithTime(this.entry.date)
    }
  },
  methods: {
    activate () {
      if (!this.isEdited) {
        this.isActive = !this.isActive
      }
    },
    deactivate () {
      this.isActive = false
    },
    startEdit () {
      this.isEdited = true
    },
    stopEdit () {
      this.isEdited = false
    },
    dayWithTime (day) {
      return DayTimeService.dayWithTime(day)
    },
    updateEntry () {
      const formData = {
        label: label,
        date: date,
        amount: amount
      }
      const errors = FormValidatorService.validateForm(formData)
      if (errors.length > 0) {
        console.log(errors)
      } else {
        HttpService.makeRequest('put', '/api/entries/' + this.entry.id, formData)
            .then(() => {
              this.$root.$emit('refreshEntries')
            })
            .catch((error) => {
              console.log(error)
            })
      }
    },
    deleteEntry () {
      HttpService.makeRequest('delete', '/api/entries/' + this.entry.id)
          .then(() => {
            this.$root.$emit('refreshEntries')
          })
          .catch((error) => {
            console.log(error)
          })
    }
  }
}
</script>
