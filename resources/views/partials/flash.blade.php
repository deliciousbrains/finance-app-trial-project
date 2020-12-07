@if (session('status'))
<div class="bg-green-600 mb-5">
    <div class="max-w-7xl mx-auto py-3 px-3 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between flex-wrap">
            <div class="w-0 flex-1 flex items-center">
                <p class="ml-1 font-medium text-white truncate">{{ session('status') }}</p>
            </div>
        </div>
    </div>
</div>
@endif

@if (session('error'))
    <div class="bg-red-600 mb-5">
        <div class="max-w-7xl mx-auto py-3 px-3 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between flex-wrap">
                <div class="w-0 flex-1 flex items-center">
                    <p class="ml-1 font-medium text-white truncate">{{ session('error') }}</p>
                </div>
            </div>
        </div>
    </div>
@endif
