<h1>Edit</h1>

{!! Form::open(['action'=> 'App\Http\Controllers\TransactionsController@update', 'method'=>'PUT']) !!} 
<div class='form-group'>
    {{Form::label('title','Title')}}
    {{Form::text('title','',['class'=>'form-control', 'placeholder'=>'Title'])}}
</div>
<div class='form-group'>
    {{Form::label('transaction_date','Date')}}
    {{Form::date('transaction_date','',['class'=>'form-control', 'placeholder'=>'0.00'])}}
</div>
<div class='form-group'>
    {{Form::label('amount','Amount')}}
    {{Form::number('amount','',['class'=>'form-control', 'placeholder'=>'0.00'])}}
</div>
{{Form::submit('Submit', ['class'=>'btn btn-primary'])}}
{!! Form::close() !!}
 