<div class="fixed z-10 inset-0 overflow-y-auto hidden" id="importModal">
  <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
    <!--
      Background overlay, show/hide based on modal state.

      Entering: "ease-out duration-300"
        From: "opacity-0"
        To: "opacity-100"
      Leaving: "ease-in duration-200"
        From: "opacity-100"
        To: "opacity-0"
    -->
    <div class="fixed inset-0 transition-opacity duration-200" aria-hidden="true">
      <div class="absolute inset-0 bg-gray-500 opacity-0 cursor-pointer" id='importModalMask'></div>
    </div>

    <!-- This element is to trick the browser into centering the modal contents. -->
    <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
    <!--
      Modal panel, show/hide based on modal state.

      Entering: "ease-out duration-300"
        From: "opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
        To: "opacity-100 translate-y-0 sm:scale-100"
      Leaving: "ease-in duration-200"
        From: "opacity-100 translate-y-0 sm:scale-100"
        To: "opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
    -->
    <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all duration-200 sm:my-8 sm:align-middle sm:max-w-5xl sm:w-full opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" role="dialog" aria-modal="true" aria-labelledby="modal-headline" id="importModalInner">

        <form action="{{ route('transaction.import') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                <div class="sm:flex sm:items-start">
                    <h2 class="text-lg leading-5 text-gray-900 font-bold mb-8" id="modal-headline">
                      Import Balance Entries
                    </h2>
                </div>

                <div class="sm:flex sm:items-start">
                    <div class="w-full">
                        <label for="file" class="font-bold text-sm uppercase tracking-tight text-gray-500">{{__('.CSV File')}}</label>
                        <x-input id="file" class="block mt-1 w-full" type="file" name="file" required />
                    </div>
                </div>
            </div>
            <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                <button type="submit" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-700 text-base font-medium text-white hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-offset-2 sm:ml-3 sm:w-auto sm:text-sm">    
                    {{ __('Import') }}
                </button>
                <a href="#" id="importCancel" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">            
                    {{ __('Cancel') }}
                </a>
            </div>
        </form>
    </div>
  </div>
</div>