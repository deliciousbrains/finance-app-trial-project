<template>
  <div>
    <div class="overflow-x-hidden overflow-y-auto fixed inset-0 z-50 outline-none focus:outline-none justify-center items-center flex">
      <div class="relative w-auto my-6 mx-auto max-w-3xl w-full">
        <!--content-->
        <div class="border-0 rounded-lg shadow-lg relative flex flex-col w-full bg-white outline-none focus:outline-none p-10">
          <!--header-->
          <div class="flex items-start justify-between p-5 text-black border-b border-solid border-blueGray-200 rounded-t">
            <h3 class="text-3xl font-semibold">
              Import Balance Entries
            </h3>
            </div>
           <div>
            <label>CSV File</label>
            </div>
            <div>
                <input type="file" id="file" ref="file" v-on:change="handleFileUpload()"/>
            </div>
            <div class="flex items-center justify-end p-6 border-t border-solid border-blueGray-200 rounded-b">
                <a @click="close" href="#" class="flex items-center mr-4 px-3 py-3 bg-gray-200 rounded-md text-black text-xs font-bold uppercase tracking-tight">
                cancel
                </a>
                <a @click="save" href="#" class="flex items-center mr-4 px-3 py-3 bg-blue-700 rounded-md text-white text-xs font-bold uppercase tracking-tight">
                Save Entry
                </a>
            </div>
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
                file: ''
            };
        },
        methods: {
            close() {
                this.$emit('close');
            },
            handleFileUpload(){
                this.file = this.$refs.file.files[0];
            },

            save() {
                let formData = new FormData();
                formData.append('file', this.file);

        axios
            .post('/api/import', formData, {headers: {'Content-Type': 'multipart/form-data', Authorization: 'Bearer ' + this.$cookies.get("user_auth")}})
            .then(response => {
                // this.$emit('reloadList');
                this.close();
            });
        }
    },
  };
</script>
