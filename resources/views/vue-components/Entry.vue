<template>
  <div class="mb-4 px-4 py-2 shadow-md bg-white rounded-md">
    <div
        class="flex flex-row items-center"
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
        >Delete</a>
      </div>
      <div class="text-lg font-bold">
        <span v-if="entry.value < 0">-</span>
        <span v-else>+</span>
        <money-value :sum="entry.value" class-name="text-sm"></money-value>
      </div>
    </div>
    <div v-show="isEdited">
      <div class="flex flex-row">
        <div class="flex flex-auto flex-col px-3 py-2 w-2/5">
          <label :for="'label' + entry.id" class="text-gray-700 font-bold uppercase py-2">Label</label>
          <input
              :id="'label' + entry.id"
              type="text"
              :value="entry.label"
              class="shadow appearance-none border rounded px-3 py-3"
          />
        </div>
        <div class="flex flex-auto flex-col px-3 py-2 w-2/5">
          <label :for="'date' + entry.id" class="text-gray-700 font-bold uppercase py-2">Date</label>
          <input
              :id="'date' + entry.id"
              type="text"
              :value="dayWithTime(entry.date)"
              class="shadow appearance-none border rounded px-3 py-3"
          />
        </div>
        <div class="flex flex-auto flex-col px-3 py-2 w-1/5">
          <label :for="'value-' + entry.id" class="text-gray-700 font-bold uppercase py-2">Amount</label>
          <div class="relative rounded border shadow px-3 py-3">
            <div class="absolute inset-y-0 left-0 px-3 flex items-center pointer-events-none">
              <span class="text-gray-500 sm:text-sm">$</span>
            </div>
            <input
              :id="'value-' + entry.id"
              type="text"
              :value="entry.value.toFixed(2)"
              class="appearance-none px-4 w-4/5"
            />
          </div>
        </div>
      </div>
      <div class="flex flex-row py-6">
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
          >Update Entry</a>
        </div>
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
import {DateTime} from "luxon";

export default {
  props: {
    entry: {
      type: Object,
      required: true
    }
  },
  data () {
    return {
      isActive: false,
      isEdited: false
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
      const dayObject = DateTime.fromISO(day).setLocale('en')
      const date = dayObject.toFormat('dd LLLL, y')
      const time = dayObject.toFormat('hh:mm a')
      return `${date} at ${time}`
    }
  }
}
</script>
