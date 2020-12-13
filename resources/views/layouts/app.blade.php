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

    @include('demo.navigation')

    <div class="mb-12 py-6 bg-gray-800">
        <div class="container mx-auto flex px-8">
            <div class="my-auto text-white flex flex-grow items-center">
                <h1 class="md:block hidden mr-4 text-2xl font-bold">
                    Your Balance
                </h1>
    
                <div class="flex flex-row">
                    <a href="#" class="flex items-center mr-4 px-3 py-2 bg-blue-700 rounded-md text-white text-xs font-bold uppercase tracking-tight">
                        Add Entry
                    </a>
                    <a href="#" class="flex items-center mr-4 px-3 py-2 bg-blue-700 rounded-md text-white text-xs font-bold uppercase tracking-tight">
                        Import CSV
                    </a>
                </div>
            </div>
            <div class="my-auto text-right font-bold text-xs uppercase tracking-tight leading-7 text-gray-400">
                Total Balance
                <span class="block text-3xl font-normal text-green-500">
                    ${{$balance}}
                </span>
            </div>
        </div>
    </div>
    @include('demo.messages')
    @yield('content')    

</div>
</body>
</html>
