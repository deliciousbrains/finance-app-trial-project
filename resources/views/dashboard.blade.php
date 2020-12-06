@extends('layouts.app')

@section('body')
    @foreach($groupedTransactions as $date => $transactions)
        <transaction-group date="{{ $date }}" :data='@json($transactions)'></transaction-group>
    @endforeach
@endsection
