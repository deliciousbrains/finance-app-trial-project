<template>
  <!--Modal-->
  <div
      class="fixed w-full h-full top-0 left-0 z-30 flex items-center justify-center"
      v-show="isAdded"
  >
    <div class="absolute w-full h-full bg-gray-900 opacity-50 z-40" @click.prevent></div>
    <div class="bg-white w-11/12 md:max-w-md mx-auto rounded shadow-lg z-50 overflow-y-auto">
      foo
    </div>
  </div>
</template>

<script>
export default {
  data () {
    return {
      isAdded: false
    }
  },
  mounted () {
    this.$root.$on('openModal', () => {
      this.isAdded = true
    });
  }
}
</script>
