@if(Auth::user()->processing)
    <div class="p-4 mb-10 full-w mx-auto border-gray-100 bg-orange-400 text-white text-bold rounded text-center overflow-auto">
        <div class="w-5 float-left">
            <svg class="animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg>
        </div>
        <div class="float-left ml-3">
            We're importing {{ number_format(Auth::user()->record_count) }} balance entries. Sit tight.
        </div>
    </div>
@endif
