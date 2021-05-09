<template>
  <div>
    <div class="mb-12 py-6 bg-gray-800">
      <div class="container mx-auto flex px-8">
        <div class="my-auto text-white flex flex-grow items-center">
          <h1 class="md:block hidden mr-4 text-2xl font-bold">
            Your Balance
          </h1>

          <div class="flex flex-row">
            <a
                href="#"
                class="flex items-center mr-4 px-3 py-2 bg-blue-700 rounded-md text-white text-xs font-bold uppercase tracking-tight"
                @click="addEntry()"
            >Add Entry</a>
            <a href="#" class="flex items-center mr-4 px-3 py-2 bg-blue-700 rounded-md text-white text-xs font-bold uppercase tracking-tight">
              Import CSV
            </a>
          </div>
        </div>
        <div class="my-auto text-right font-bold text-xs uppercase tracking-tight leading-7 text-gray-400">
          Total Balance
          <span class="block text-3xl font-normal text-green-500">
            <money-value :sum="total" class-name="text-xl"></money-value>
          </span>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import Http from '../vue-services/HttpService'

export default {
  data () {
    return {
      total: 0
    }
  },
  methods: {
    addEntry () {
      this.$root.$emit('openModal')
    },
    getTotal () {
      Http.makeRequest('get', '/api/entries/total')
          .then((response) => {
            this.total = response.data.total
          })
          .catch((error) => {
            console.log(error)
          })
    }
  },
  mounted () {
    this.getTotal()
    this.$root.$on('refreshEntries', () => {
      this.getTotal()
    })
  }
}
</script>
