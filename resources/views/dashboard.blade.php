@extends('layouts.app')

@section('body')
    @foreach($groupedTransactions as $date => $transactions)
        <transaction-group date="{{ $date }}" :data='@json($transactions)' @update="updateCurrentBalance" @remove="updateCurrentBalance"></transaction-group>
    @endforeach
@endsection
