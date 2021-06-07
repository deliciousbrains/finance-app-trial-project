<template>
  <div>

      <div class="relative w-auto -mt-7 mb-6 mx-auto max-w-6xl">
        <!--content-->
        <div class="border-0 rounded-lg shadow-lg relative flex flex-col w-full bg-white outline-none focus:outline-none">
          <form action="POST" class="text-black w-full">
                <div class="flex flex-wrap m-5">
                    <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                        <label for="label" class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" >label</label>
                        <input v-model="label" type="text" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" placeholder="Label" id="label">
                    </div>
                    <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                        <label for="label" class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" >date</label>
                        <input v-model="date" type="text" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" placeholder="Date" id="date">
                    </div>
                    <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                        <label for="label" class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" >amount</label>
                        <input v-model="value" type="text" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" placeholder="Amount" id="amount">
                    </div>
                </div>
            <div class="flex items-center justify-end p-6 border-t border-solid border-blueGray-200 rounded-b">
                <a @click="close()" href="#" class="flex items-center mr-4 px-3 py-3 bg-gray-200 rounded-md text-black text-xs font-bold uppercase tracking-tight">
                cancel
                </a>
                <a @click="save()" href="#" class="flex items-center mr-4 px-3 py-3 bg-blue-700 rounded-md text-white text-xs font-bold uppercase tracking-tight">
                Update Entry
                </a>
            </div>
            </form>
        </div>
      </div>
  </div>
</template>

<script>
    export default {
        props: ['trans', 'index'],
        data() {
            return {
                label: this.trans[this.index].label,
                date: this.trans[this.index].date,
                value: this.trans[this.index].value
            };
        },
        methods: {
            close() {
                this.$emit('close');
            },
        save() {
            let params = {
                'label': this.label,
                'date': this.date,
                'value': Number(this.value),
                'account_id': this.trans[this.index].account_id
            }
            axios
                .put('/api/transactions/' + this.trans[this.index].id, params, {headers: {Authorization: 'Bearer ' + this.$cookies.get("user_auth")}})
                .then(response => {
                    this.$emit('itemupdated');
                    this.close();
                });
            }
        },
    };
</script>
