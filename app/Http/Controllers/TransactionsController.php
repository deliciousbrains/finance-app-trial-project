<?php

namespace App\Http\Controllers;

use View,Auth,Session,File,Artisan,Excel;
use App\Models\Transactions;
use App\Http\Requests\TransactionAddRequest;
use App\Http\Requests\ImportRequest;
use App\Jobs\TransactionsImport;
use Illuminate\Http\Request;

class TransactionsController extends Controller
{
    /**
     * Display a listing of user transactions.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();

        $transactions = $user->transactions()->orderby('date','DESC')->paginate(20);

        $total=$user->transactions()->sum('amount');

        return View::make('layouts.app',compact('user','transactions','total'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created transaction.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TransactionAddRequest $request)
    {
        $user = Auth::user();
        $transaction = new Transactions();
        $transaction->label=$request->label;
        $transaction->amount=$request->amount;
        $transaction->date=date("Y-m-d H:i:s",strtotime($request->date));
        $transaction->user_id=$user->id;
        $transaction->save();

        Session::flash('addSuccess','Transaction has been successfully added.');

        return redirect('/dashboard');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Transactions  $transactions
     * @return \Illuminate\Http\Response
     */
    public function update(TransactionAddRequest $request)
    {
        $user = Auth::user();
        $transaction = Transactions::where('id',$request->id)->where('user_id',$user->id)->first();
        if(is_null($transaction)){
            Session::flash("errorMsg","There has been an error with your update. Please try again.");
            return redirect('/dashboard');
        }

        $transaction->label=$request->label;
        $transaction->amount=$request->amount;
        $transaction->date=date("Y-m-d H:i:s",strtotime($request->date));
        $transaction->save();

        $page=$request->input('page')?"?page=".$request->input('page'):'';
        Session::flash("addSuccess","Transaction has been successfully updated.");
        return redirect('/dashboard'.$page);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Transactions  $transactions
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Transactions::find($id)->delete();

        Session::flash('addSuccess','Transaction has been successfully deleted.');
        return redirect('/dashboard');
    }

    /**
     * Save a CSV and queue an import command.
     *
     */
    public function import(ImportRequest $request)
    {

        // save to storage
        $file = $request->file('file');
        $filename = uniqid().".".File::extension($file->getClientOriginalName());
        $file->move(storage_path('app\import'),$filename);

        // queue command to process the csv
        $user=Auth::user();
        //Artisan::queue('importTransactions '.$user->id.' '.$filename)->delay(0);
        $this->dispatch(new TransactionsImport($filename));

        // return
        $fp=file(storage_path('app\import')."/".$filename);
        $count=count($fp)-1;
        Session::put('waitingMsg',"We're importing ".$count." balance entries. Sit tight.");
        return redirect('/dashboard');
    }
}
