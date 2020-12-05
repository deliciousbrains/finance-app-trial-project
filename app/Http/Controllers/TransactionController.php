<?php

namespace App\Http\Controllers;

use App\Events\NewTransaction;
use App\Http\Requests\TransactionStoreRequest;
use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function index(Request $request)
    {
        $transactions = Transaction::all();

        return view('dashboard', compact('transactions'));
    }

    public function store(TransactionStoreRequest $request)
    {
        $transaction = Transaction::create($request->validated());

        event(new NewTransaction($transaction));
        $request->session()->flash('transaction.label', $transaction->label);

        return redirect()->route('dashboard');
    }
}
