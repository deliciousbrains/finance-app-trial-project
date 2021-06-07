<template>
  <div>
    <div class="overflow-x-hidden overflow-y-auto fixed inset-0 z-50 outline-none focus:outline-none justify-center items-center flex">
      <div class="relative w-auto my-6 mx-auto max-w-6xl">
        <!--content-->
        <div class="border-0 rounded-lg shadow-lg relative flex flex-col w-full bg-white outline-none focus:outline-none">
          <!--header-->
          <div class="flex items-start justify-between p-5 text-black border-b border-solid border-blueGray-200 rounded-t">
            <h3 class="text-3xl font-semibold">
              Add Balance Entry
            </h3>
          </div>
          <form action="POST" class="text-black w-full">
                <div class="flex flex-wrap m-5">
                    <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                        <label for="label" class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" >label</label>
                        <input v-model="label" type="text" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" placeholder="Label" id="label">
                    </div>
                    <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                        <label for="date" class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" >date</label>
                        <input v-model="date" type="text" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" placeholder="Date" id="date">
                    </div>
                    <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                        <label for="amount" class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" >amount</label>
                        <input v-model="value" type="text" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" placeholder="Amount" id="amount">
                    </div>
                </div>
            <div class="flex items-center justify-end p-6 border-t border-solid border-blueGray-200 rounded-b">
                <a @click="close" href="#" class="flex items-center mr-4 px-3 py-3 bg-gray-200 rounded-md text-black text-xs font-bold uppercase tracking-tight">
                cancel
                </a>
                <a @click="save" href="#" class="flex items-center mr-4 px-3 py-3 bg-blue-700 rounded-md text-white text-xs font-bold uppercase tracking-tight">
                Save Entry
                </a>
            </div>
            </form>
        </div>
      </div>
    </div>
    <div class="opacity-50 fixed inset-0 z-40 bg-black"></div>
  </div>
</template>

<script>
    export default {
        props: ['accountId'],
        data() {
            return {
                label: "",
                date: "",
                value: 0.00
            };
        },
        methods: {
            close() {
                this.$emit('close');
        },
        save() {
        let params = {
            "label" : this.label,
            "value" : this.value,
            "date": this.date,
            "account_id": this.accountId
        };
        axios
            .post('/api/transactions', params, {headers: {Authorization: 'Bearer ' + this.$cookies.get("user_auth")}})
            .then(response => {
                this.$emit('reloadList');
                this.close();
            });
        }
    },
  };
</script>
