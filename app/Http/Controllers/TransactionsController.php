<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;

class TransactionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $balance=Transaction::sum('amount');
        $transactions= Transaction::orderBy('transaction_date','desc')->paginate(3);
        return view('dashboard')->with(['transactions'=>$transactions, 'balance'=>$balance]);
//        return view('demo.transactions')->with('transactions',$transactions);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return "create form";
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // POST
        $this->validate($request, [
            'title'=>'required',
            'amount'=>'required',
            'transaction_date'=>'required'
        ]);
        $transaction = new Transaction;
        $transaction->title=$request->input('title');
        $transaction->amount=$request->input('amount');
        $transaction->transaction_date=$request->input('transaction_date');
        $transaction->save();
        return redirect('/dashboard')->with('success','Transaction added');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return "edit form";
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Transaction::find($id);
        $post->delete();
        return redirect('/dashboard')->with('success','Transaction deleted');
    }
}
