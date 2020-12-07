<template>
    <Transition name="fade">
        <div v-if="open" class="fixed z-10 inset-0 overflow-y-auto">
            <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                    <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
                </div>
                <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
                <div class="inline-block align-bottom bg-white rounded-lg text-left shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-2xl sm:w-full" role="dialog" aria-modal="true" aria-labelledby="modal-headline">
                    <form :action="action" method="POST" :enctype="upload ? 'multipart/form-data' : 'application/x-www-form-urlencoded'">
                        <h2 class="xl:font-extrabold text-black text-xl px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                            {{ heading }}
                        </h2>

                        <hr />

                        <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                            <slot />
                        </div>

                        <div class="bg-gray-100 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                            <button type="submit" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-600 text-base font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:ml-3 sm:w-auto sm:text-sm">
                                Submit
                            </button>
                            <button type="button" @click.prevent="close" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                                Cancel
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </Transition>
</template>

<script>
export default {
    props: {
        heading: {
            required: true,
            type: String
        },
        action: {
            required: true,
            type: String
        },
        showing: {
            required: true,
            type: Boolean
        },
        upload: {
            required: false,
            type: Boolean
        }
    },
    data() {
        return {
            open: this.showing
        }
    },
    watch: {
        showing() {
            this.open = this.showing
        }
    },
    methods: {
        close() {
            this.$emit('close');
            this.open = false;
        },
    }
};
</script>
