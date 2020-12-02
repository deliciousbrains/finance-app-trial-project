<template>
    <span>
        <a href="#" @click="open = true" class="flex items-center mr-4 px-3 py-2 bg-blue-700 rounded-md text-white text-xs font-bold uppercase tracking-tight">
            Add Entry
        </a>
        <modal v-if="open" v-model="open">
            <template v-slot:header>Add Balance Entry</template>
            <template v-slot:body>
                <add-entry-form :data.sync="data"></add-entry-form>
                <button @click="hello">Show me the data</button>
            </template>
        </modal>
    </span>
</template>

<script>
import Modal from '../modal'
import AddEntryForm from './form'
export default {
    components: {
        Modal,
        AddEntryForm,
    },
    data() {
        return {
            open: true,
            data: { label: 'Test' },
        }
    },
    methods: {
        hello: function () {
            console.log(this.data)
        }
    }
}
</script>