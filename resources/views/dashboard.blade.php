<x-app-layout>
    <x-slot name="content">
        <div class="bg-white">
            <div class="container mx-auto px-8 py-4 flex flex-row">
                <a href="#" class="logo text-xl font-semibold flex-initial flex flex-row items-center tracking-wider">
                    <img src="/images/logo.svg" class="mr-4"/>
                    Your<span class="text-blue-600">Balance</span>
                </a>
                <div class="flex content-center flex-row flex-grow justify-end h-full">
                    <a href="#" class="flex">
                        <svg xmlns="http://www.w3.org/2000/svg" class="block mx-auto my-auto" width="16" height="16" viewBox="0 0 16 16">
                            <path class="notificationIcon" fill="#A0A5BA" d="M10 14L6 14C6 15.1 6.9 16 8 16 9.1 16 10 15.1 10 14zM15 11L14.5 11C13.8 10.3 13 9.3 13 8L13 5C13 2.2 10.8 0 8 0 5.2 0 3 2.2 3 5L3 8C3 9.3 2.2 10.3 1.5 11L1 11C.4 11 0 11.4 0 12 0 12.6.4 13 1 13L15 13C15.6 13 16 12.6 16 12 16 11.4 15.6 11 15 11z"/>
                        </svg>
                    </a>
                    <a href="#" class="flex items-center font-bold text-sm text-gray-500">
                        <img src="/images/avatar.png" class="w-8 mx-4"/>
                        {{ Auth::User()->name }}
                    </a>
                </div>
            </div>

            <div class="container mx-auto px-8">
                {{-- <dashboard-component @update-list="fetchList()"></dashboard-component> --}}
                <div id="app">
                    <app></app>
                </div>
            </div>
        </div>
    </x-slot>
</x-app-layout>
