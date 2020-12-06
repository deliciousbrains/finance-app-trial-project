<template>
    <span>
        <a href="#" @click="showModal = true" class="flex items-center mr-4 px-3 py-2 bg-blue-700 rounded-md text-white text-xs font-bold uppercase tracking-tight">
            Add Entry
        </a>

        <modal :showing="showModal" :heading="heading" :action="action">
            <div class="grid grid-cols-9 gap-6 mb-5">
                <div class="col-span-6 sm:col-span-4">
                    <label for="label" class="block text-sm font-medium text-gray-700 uppercase">Label</label>
                    <input type="text" name="label" id="label" autocomplete="label" required="required" class="mt-1 text-black focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border border-gray-300 rounded-md">
                </div>

                <div class="col-span-6 sm:col-span-3">
                    <label for="occurred_at" class="block text-sm font-medium text-gray-700 uppercase">Date</label>
                    <datetime :type="'datetime'" :hidden-name="'occurred_at'" v-model="occurredAt" :required="true" :use12-hour="true" :input-class="'mt-1 text-black focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border border-gray-300 rounded-md'"></datetime>
                </div>

                <div class="col-span-6 sm:col-span-2">
                    <label for="amount" class="block text-sm font-medium text-gray-700 uppercase">Amount</label>
                    <input type="text" name="amount" id="amount" autocomplete="amount"  required="required" class="mt-1 text-black focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border border-gray-300 rounded-md">
                </div>
            </div>

            <slot />
        </modal>
    </span>
</template>

<script>
import { Datetime } from 'vue-datetime';
import 'vue-datetime/dist/vue-datetime.css';

export default {
    name: "new-entry",
    props: {
        action: {
            required: true,
            type: String
        }
    },
    components: {
        Datetime,
    },
    data() {
        return {
            showModal: false,
            heading: 'Add Balance Entry',
            occurredAt: '',
        }
    }
}
</script>
