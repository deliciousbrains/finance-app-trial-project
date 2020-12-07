<template>
    <span>
        <button type="button" @click="showModal = true" :disabled="isDisabled" class="flex items-center mr-4 px-3 py-2 bg-blue-700 disabled:opacity-50 rounded-md text-white text-xs font-bold uppercase tracking-tight">
            Import CSV
        </button>

        <modal :showing="showModal" :heading="heading" :action="action" :upload="true">
            <div>
                <label for="bulk" class="relative cursor-pointer bg-white rounded-md font-medium text-indigo-600 hover:text-indigo-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-indigo-500">
                  <input id="bulk" name="bulk" type="file" class="mt-1 block w-full">
                </label>
            </div>

            <slot />
        </modal>
    </span>
</template>

<script>
export default {
    name: "bulk-import",
    props: {
        action: {
            required: true,
            type: String
        },
        processing: {
            required: true,
            type: String
        }
    },
    data() {
        return {
            showModal: false,
            heading: 'Import Balance Entries',
        }
    },
    computed: {
        isDisabled() {
            return this.processing === 'true'
        }
    }
}
</script>
