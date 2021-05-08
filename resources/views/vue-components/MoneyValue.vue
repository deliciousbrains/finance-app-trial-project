<template>
  <span>
    ${{ dollars }}.<span :class="className">{{ cents }}</span>
  </span>
</template>

<script>
export default {
  props: {
    sum: {
      required: true,
      type: Number
    },
    className: {
      required: true,
      type: String
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
      const absoluteSum = Math.abs(this.sum)
      const sumString = absoluteSum.toLocaleString('en', {maximumFractionDigits: 2, minimumFractionDigits: 2})
      return sumString.split('.')
    }
  }
}
</script>
