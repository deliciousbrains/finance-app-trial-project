<template>
  <div>
    <dashboard-header></dashboard-header>
    <dashboard-total></dashboard-total>
    <dashboard-main></dashboard-main>
    <dashboard-modal></dashboard-modal>
  </div>
</template>

<script>
import HeaderComponent from './vue-components/Header'
import TotalComponent from './vue-components/Total'
import MainComponent from './vue-components/Main'
import ModalComponent from './vue-components/Modal'

export default {
  components: {
    'dashboardHeader': HeaderComponent,
    'dashboardTotal': TotalComponent,
    'dashboardMain': MainComponent,
    'dashboardModal': ModalComponent
  }
}
</script>
