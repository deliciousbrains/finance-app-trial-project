<template>
    <span>
        <a href="#" @click="open = true" class="flex items-center mr-4 px-3 py-2 bg-blue-700 rounded-md text-white text-xs font-bold uppercase tracking-tight">
            Add Entry
        </a>
        <modal v-if="open" v-model="open">
            <template v-slot:header>Add Balance Entry</template>
            <template v-slot:body>
                <ul class="bg-red-100 border border-red-500 text-red-500 rounded p-2 mb-6 text-xs" v-if="errors.length">
                    <li v-for="(error, index) in errors" :key="index">{{ error }}</li>
                </ul>
                <div v-if="success" class="bg-green-100 border border-green-500 text-green-500 rounded p-2 mb-6 text-xs">Successfully created entry.</div>
                <add-entry-form :data.sync="data"></add-entry-form>
            </template>
            <template v-slot:footer>
                <button class="text-xs uppercase font-semibold px-4 py-2 rounded bg-blue-700 text-white" @click="save">Save Entry</button>
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
            open: false,
            data: {},
            errors: [],
            success: false,
        }
    },
    methods: {
        save: function () {
            this.errors = []
            this.success = false
            axios.post(route('transactions.store'), this.data)
                .then(res => {
                    this.success = true
                    this.data = {}
                })
                .catch(err => {
                    if (err.response) {
                        for (const field in err.response.data) {
                            this.errors.push(err.response.data[field][0])
                        }
                    }
                })
        }
    }
}
</script>