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
      <entry-form></entry-form>
      <div class="flex flex-row py-6 px-6">
        <div class="flex-grow"></div>
        <div class="flex flex-row">
          <a
              href="#"
              @click="stopAdd()"
              class="flex bg-blue-100 text-gray-500 rounded-md font-bold items-center uppercase mr-4 px-6 py-4"
          >Cancel</a>
          <a
              href="#"
              class="flex bg-blue-700 text-white rounded-md font-bold items-center uppercase mr-4 px-6 py-4"
          >Save Entry</a>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import EntryFormComponent from "./EntryForm";

export default {
  components: {
    entryForm: EntryFormComponent
  },
  data () {
    return {
      isAdded: false
    }
  },
  methods: {
    stopAdd () {
      this.isAdded = false
    }
  },
  mounted () {
    this.$root.$on('openModal', () => {
      this.isAdded = true
    });
  }
}
</script>
