<template>
  <div>
    <dashboard-header></dashboard-header>
    <dashboard-total></dashboard-total>
    <dashboard-main></dashboard-main>
  </div>
</template>

<script>
import HeaderComponent from './vue-components/Header'
import TotalComponent from './vue-components/Total'
import MainComponent from './vue-components/Main'

export default {
  components: {
    'dashboardHeader': HeaderComponent,
    'dashboardTotal': TotalComponent,
    'dashboardMain': MainComponent
  }
}
</script>
