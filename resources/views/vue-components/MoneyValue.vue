<template>
  <span>
    ${{ dollars }}.<span class="text-xl">{{ cents }}</span>
  </span>
</template>

<script>
export default {
  props: {
    sum: {
      required: true,
      type: Number
    }
  },
  computed: {
    dollars () {
      const split = this.splitSum()
      return split[0]
    },
    cents () {
      const split = this.splitSum()
      return split[1]
    }
  },
  methods: {
    splitSum () {
      const sumString = this.sum.toLocaleString('en', {maximumFractionDigits: 2, minimumFractionDigits: 2})
      return sumString.split('.')
    }
  }
}
</script>
