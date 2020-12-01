<template>
    <span>
        <a href="#" @click="open = true" class="flex items-center mr-4 px-3 py-2 bg-blue-700 rounded-md text-white text-xs font-bold uppercase tracking-tight">
            Add Entry
        </a>
        <modal v-if="open" v-model="open">
            <template v-slot:header>Add Balance Entry</template>
        </modal>
    </span>
</template>

<script>
import Modal from '../modal'
export default {
    components: {
        Modal,
    },
    data() {
        return {
            open: false,
        }
    },
    mounted: function () {
        console.log('mounted')
    }
}
</script>