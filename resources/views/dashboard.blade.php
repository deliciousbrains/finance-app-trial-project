@extends('layouts.app')


@section('content')

<?php
$previous_day_group='';
?>

<div class="container mx-auto px-8">
    <div class="mb-8">
        <div>

    @if (count($transactions)>0) 
        @foreach($transactions as $transaction)

        @if ($previous_day_group!=$transaction->tdate) 
        <?php 
        $previous_day_group=$transaction->tdate;
        ?>

    </div>
    <div class="flex items-center mb-4">
        <span class="flex-grow text-gray-500 font-bold text-sm uppercase tracking-tight">{{$transaction->tdate}}</span>
        <span class="text-lg text-gray-500 font-bold">{{$transaction->tdatetotal}}</span>
    </div>

        @endif

    <div>
        <div class="flex items-center mb-4 px-4 py-2 shadow-md bg-white rounded-md">
            <div class="flex-grow">
                <div class="font-bold">
                    {{$transaction->title}} 
                </div>
                <div class="text-xs text-gray-500">
                    {{$transaction->transaction_date}}
                </div>
            </div>
            <div class='transaction-item-links'>
                <a href='#'>Edit</a>&nbsp;&nbsp;&nbsp;
                {!!Form::open(['action' => ['App\Http\Controllers\TransactionsController@destroy', $transaction->id],'method'=>'POST', 'class'=>'pull-right'])!!}
                {{Form::hidden('_method','DELETE')}}
                {{Form::submit('Delete',['class'=>'btn btn-danger'])}}
                {!!Form::close()!!}

            </div>
            <div class="text-lg font-bold transaction-item-amt">
                {{$transaction->amount}} 
            </div>
        </div>

        @endforeach
    </div>
    {{ $transactions->links()}}
 
    @endif

    </div>
</div>


@endsection
