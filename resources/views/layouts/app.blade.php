<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;500;600;700&display=swap">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
</head>
<body class="bg-gray-100 font-sans antialiased">
<div id="app">
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
                    {{ $user->name }}
                </a>
            </div>
        </div>
    </div>

    <div class="mb-12 py-6 bg-gray-800">
        <div class="container mx-auto flex px-8">
            <div class="my-auto text-white flex flex-grow items-center">
                <h1 class="md:block hidden mr-4 text-2xl font-bold">
                    Your Balance
                </h1>

                <div class="flex flex-row">
                    <transaction-add-entry></transaction-add-entry>
                    <a href="#" class="flex items-center mr-4 px-3 py-2 bg-blue-700 rounded-md text-white text-xs font-bold uppercase tracking-tight">
                        Import CSV
                    </a>
                </div>
            </div>
            <div class="my-auto text-right font-bold text-xs uppercase tracking-tight leading-7 text-gray-400">
                Total Balance
                <span class="block text-3xl font-normal text-green-500">
                    $1,725.<span class="text-xl">00</span>
                </span>
            </div>
        </div>
    </div>

    <div class="container mx-auto px-8">
        {{ $slot }}
        {{-- <div class="mb-8">
            <div class="flex items-center mb-4">
                <span class="flex-grow text-gray-500 font-bold text-sm uppercase tracking-tight">Today</span>
                <span class="text-lg text-gray-500 font-bold">- $50.<span class="text-sm">00</span></span>
            </div>

            <div>
                <div class="flex items-center mb-4 px-4 py-2 shadow-md bg-white rounded-md">
                    <div class="flex-grow">
                        <div class="font-bold">
                            Groceries
                        </div>
                        <div class="text-xs text-gray-500">
                            20 May, 2020 at 10:55 PM
                        </div>
                    </div>
                    <div class="text-lg font-bold">
                        - $60.<span class="text-sm">00</span>
                    </div>
                </div>
                <div class="flex items-center mb-4 px-4 py-2 shadow-md bg-white rounded-md">
                    <div class="flex-grow">
                        <div class="font-bold">
                            Lottery Win
                        </div>
                        <div class="text-xs text-gray-500">
                            20 May, 2020 at 09:05 AM
                        </div>
                    </div>
                    <div class="text-lg font-bold text-green-500">
                        + $10.<span class="text-sm">00</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="mb-8">
            <div class="flex items-center mb-4">
                <span class="flex-grow text-gray-500 font-bold text-sm uppercase tracking-tight">Yesterday</span>
                <span class="text-lg text-gray-500 font-bold">- $500.<span class="text-sm">00</span></span>
            </div>

            <div>
                <div class="flex items-center mb-4 px-4 py-2 shadow-md bg-white rounded-md">
                    <div class="flex-grow">
                        <div class="font-bold">
                            Car Insurance
                        </div>
                        <div class="text-xs text-gray-500">
                            19 May, 2020 at 08:00 AM
                        </div>
                    </div>
                    <div class="text-lg font-bold">
                        - $500.<span class="text-sm">00</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="mb-8">
            <div class="flex items-center mb-4">
                <span class="flex-grow text-gray-500 font-bold text-sm uppercase tracking-tight">Mon, 11 May</span>
                <span class="text-lg text-green-500 font-bold">+ $3,000.<span class="text-sm">00</span></span>
            </div>

            <div>
                <div class="flex items-center mb-4 px-4 py-2 shadow-md bg-white rounded-md">
                    <div class="flex-grow">
                        <div class="font-bold">
                            Opening Balance
                        </div>
                        <div class="text-xs text-gray-500">
                            11 May, 2020 at 10:00 AM
                        </div>
                    </div>
                    <div class="text-lg text-green-500 font-bold">
                        + $3,000.<span class="text-sm">00</span>
                    </div>
                </div>
            </div>
        </div> --}}
    </div>
</div>
</body>
</html>
