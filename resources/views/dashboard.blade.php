@inject('carbon', 'Carbon\Carbon')
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @foreach ($transactions as $date => $dateGroup)
            <div class="flex flex-col">
                <div class="flex">
                    <span class="flex-grow text-xs text-gray-400 uppercase font-bold">
                        @if ($carbon::parse($date)->isToday())
                            Today
                        @elseif ($carbon::parse($date)->isYesterday())
                            Yesterday
                        @else
                            {{ $carbon->parse($date)->format('D, d M Y') }}
                        @endif
                    </span>
                    <span class="text-lg {{ $dateGroup->sum('amount') >= 0 ? ' text-green-500' : 'text-gray-400' }}">
                        {{ $dateGroup->sum('amount') < 0 ? '-' : '' }} ${{ ltrim(number_format($dateGroup->sum('amount'), 2), '-') }}
                    </span>
                </div>
                @foreach ($dateGroup as $transaction)
                    <transaction-dashboard-item></transaction-dashboard-item>
                @endforeach
            </div>

            @endforeach
        </div>
    </div>
</x-app-layout>
