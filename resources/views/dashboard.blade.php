@extends('layouts.app')

@section('body')
    @foreach($groupedTransactions as $date => $details)
        <div class="mb-8">
            <div class="flex items-center mb-4">
                <span class="flex-grow text-gray-500 font-bold text-sm uppercase tracking-tight">{{ $date }}</span>
                <span class="text-lg text-gray-500 font-bold {{ $details['total'] > 0 ? 'text-green-500' : '' }}">
                    {{ $details['total'] > 0 ? '+ ' : '- ' }}
                    ${{ number_format(abs($details['total'])) }}.<span class="text-sm">{{ \Illuminate\Support\Str::after(number_format($details['total'], 2), '.') }}</span>
                </span>
            </div>

            <div>
                @foreach($details['transactions'] as $transaction)
                <transaction :data='@json($transaction)'></transaction>
                @endforeach
            </div>
        </div>
    @endforeach
@endsection
