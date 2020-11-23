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
    
    <style>
        .transaction-row .links{ opacity: 0; }
        .transaction-row:hover .links{ opacity: 1; }    
        .transaction-row .edit-form{ display: none; }
        .transaction-row.active .edit-form{ display: block; }
    </style>
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
                    <a href="#" class="flex items-center mr-4 px-3 py-2 bg-blue-700 rounded-md text-white text-xs font-bold uppercase tracking-tight {{Session::has('waitingMsg')?"opacity-75 cursor-default":""}}" 
                        @if(!Session::has('waitingMsg'))
                        id="addBtn"
                        @endif
                        >
                        Add Entry
                    </a>
                    <a href="#" class="flex items-center mr-4 px-3 py-2 bg-blue-700 rounded-md text-white text-xs font-bold uppercase tracking-tight {{Session::has('waitingMsg')?"opacity-75 cursor-default":""}}" 
                        @if(!Session::has('waitingMsg'))
                        id="importBtn"
                        @endif
                        >
                        Import CSV
                    </a>
                </div>
            </div>
            <div class="my-auto text-right font-bold text-xs uppercase tracking-tight leading-7 text-gray-400">
                Total Balance
                <span class="block text-3xl font-normal text-green-500">
                    ${{ number_format(floor($total)) }}<span class="text-xl">{{ ltrim(number_format(($total - floor($total)),2),'0') }}</span>
                    
                </span>
            </div>
        </div>
    </div>

    <div class="container mx-auto px-8">
        @if(Session::has("addSuccess"))
            <div class="mb-5 bg-green-200 text-gray-500 rounded-md p-4">
                {{Session::get('addSuccess')}}
            </div>
        @endif
        @if(Session::has("errorMsg"))
            <div class="mb-5 bg-red-200 text-gray-500 rounded-md p-4">
                {{Session::get('errorMsg')}}
            </div>
        @endif
        @if(Session::has("waitingMsg"))
            <div class="mb-5 bg-orange-200 text-gray-500 rounded-md p-4">
                {{Session::get('waitingMsg')}}
            </div>
        @endif        

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-5 bg-red-200 text-gray-500 rounded-md p-4" :errors="$errors" />
        <div class="mb-8">
            @php
                $currentDate=0;
            @endphp
            @foreach($transactions as $t)
                @if(date("Y-m-d",strtotime($t->date))!=$currentDate)
                    @php
                        $currentDate=date("Y-m-d",strtotime($t->date));
                        $dayTotal = $user->transactions()->whereRaw('DATE(`date`)="'.$currentDate.'"')->sum('amount');
                    @endphp
                    <div class="flex items-center mb-4">
                        <span class="flex-grow text-gray-500 font-bold text-sm uppercase tracking-tight">
                            @if($currentDate==date("Y-m-d"))
                                Today
                            @elseif(date("Y-m-d",strtotime("-1 day"))==$currentDate) 
                                Yesterday
                            @else
                            {{ date("D, d M",strtotime($currentDate)) }}
                            @endif
                        </span>
                        <span class="text-lg {{ ($dayTotal<0?"text-gray-500":"text-green-500") }} font-bold">
                            {{ ($dayTotal<0?"-":"+") }}
                            ${{ floor(abs($dayTotal)) }}<span class="text-sm">{{ ltrim(number_format(abs($dayTotal) - floor(abs($dayTotal)),2),'0') }}
                        </span>
                    </div>
                @endif
                <div class="transaction-row flex flex-wrap items-center mb-4 px-4 py-2 shadow-md hover:shadow-lg bg-white rounded-md">
                    <div class="flex-grow">
                        <div class="font-bold">
                            {{$t->label}}
                        </div>
                        <div class="text-xs text-gray-500">
                            {{ date("d M, Y",strtotime($t->date))." at ".date("H:m A",strtotime($t->date)) }}
                        </div>
                    </div>
                    <div class="links duration-100 mr-8 uppercase font-bold text-sm transition-opacity">
                        <a class="mr-4 text-blue-600 underline" href="#" onclick="this.parentNode.parentNode.classList.add('active'); return false;">Edit</a><a class="text-blue-600 underline" href="/transaction/delete/{{$t->id}}" onclick="return confirm('Are you sure?')">Delete</a>
                    </div>
                    <div class="text-lg font-bold {{ $t->amount>0?"text-green-500":'' }}">
                        {{ ($t->amount<0?"-":"+") }}
                        ${{ floor(abs($t->amount)) }}<span class="text-sm">{{ ltrim(number_format(abs($t->amount) - floor(abs($t->amount)),2),'0') }}
                    </div>
                    <div class="edit-form w-full">
                        <form action="{{ route('transaction.update') }}{{isset($_GET['page'])?"?page=".$_GET['page']:""}}" method="post">
                            @csrf
                            <input type="hidden" name="id" value="{{ $t->id }}">
                            <div class="bg-white pt-4">

                                <div class="sm:flex sm:items-start">
                                    <div class="w-2/5">
                                        <label for="label" class="font-bold text-sm uppercase tracking-tight text-gray-500">{{__('Label')}}</label>
                                        <x-input id="label" class="block mt-1 w-full" type="text" value="{{$t->label}}" name="label" required />
                                    </div>
                                    <div class="w-2/5 ml-4">
                                        <label for="date" class="font-bold text-sm uppercase tracking-tight text-gray-500">{{__('Date')}}</label>
                                        <x-input id="date" class="block mt-1 w-full" type="text" value="{{$t->date}}" name="date" required />                    
                                    </div>
                                    <div class="w-1/5 ml-4">
                                        <label for="amount" class="font-bold text-sm uppercase tracking-tight text-gray-500">{{__('Amount')}}</label>
                                        <div class="flex mt-1 items-stretch">
                                            <div class="flex -mr-px">
                                                <span class="flex items-center leading-normal rounded-md rounded-r-none border px-3 whitespace-no-wrap text-grey-dark text-sm">$</span>
                                            </div>
                                            <x-input id="amount" class="block flex-shrink flex-grow rounded-l-none flex-auto leading-normal w-px flex-1 border h-10 border-grey-light px-3 relative border-l-0" type="text" name="amount" value="{{$t->amount}}" required />  
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="pt-3 sm:flex sm:flex-row-reverse">
                                <button type="submit" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-700 text-base font-medium text-white hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-offset-2 sm:ml-3 sm:w-auto sm:text-sm">    
                                    {{ __('Update Entry') }}
                                </button>
                                <a href="#" class="editCancel mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm" onclick="this.parentNode.parentNode.parentNode.parentNode.classList.remove('active'); return false;">            
                                    {{ __('Cancel') }}
                                </a>
                            </div>
                        </form>
                    </div>
                </div>                
            @endforeach
            {!! $transactions->render() !!}
        </div>
    </div>
</div>
@include('layouts.includes.addModal')
@include('layouts.includes.importModal')
<script>
    var showModal=function(id){
        var modal = document.getElementById(id);
        modal.classList.remove("hidden");
        var inner = document.getElementById(id+'Inner');
        inner.classList.remove('opacity-0');
        inner.classList.remove('translate-y-4');
        inner.classList.remove('sm:translate-y-0');
        inner.classList.remove('sm:scale-95');
        inner.classList.add('opacity-100');
        inner.classList.add('translate-y-0');
        inner.classList.add('sm:scale-100');
        var mask = document.getElementById(id+'Mask');
        mask.classList.remove('opacity-0');
        mask.classList.add('opacity-75');
        return false;
    };
    var hideModal=function(id){
        var inner = document.getElementById(id+'Inner');
        inner.classList.remove('opacity-100');
        inner.classList.remove('translate-y-0');
        inner.classList.remove('sm:scale-100');
        inner.classList.add('opacity-0');
        inner.classList.add('translate-y-4');
        inner.classList.add('sm:translate-y-0');
        inner.classList.add('sm:scale-95');
        var mask = document.getElementById(id+'Mask');
        mask.classList.remove('opacity-75');
        mask.classList.add('opacity-0');
        var modal = document.getElementById(id);
        modal.classList.add("hidden");
        return false;
    };
    var addBtn = document.getElementById('addBtn');
    addBtn.addEventListener("click",function(){
        showModal('addModal')
    });

    var addMask = document.getElementById('addModalMask');
    addMask.addEventListener("click",function(){
        hideModal('addModal')
    });

    var addCancel = document.getElementById('addCancel');
    addCancel.addEventListener("click",function(){
        hideModal('addModal')
    });

    var importBtn = document.getElementById('importBtn');
    importBtn.addEventListener("click",function(){
        showModal('importModal')
    });

    var importMask = document.getElementById('importModalMask');
    importMask.addEventListener("click",function(){
        hideModal('importModal')
    });

    var importCancel = document.getElementById('importCancel');
    importCancel.addEventListener("click",function(){
        hideModal('importModal')
    });
</script>
</body>
</html>
