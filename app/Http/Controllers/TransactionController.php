<?php

namespace App\Http\Controllers;

use App\Events\NewTransaction;
use App\Http\Requests\TransactionStoreRequest;
use App\Models\Transaction;
use App\Repositories\Transactions;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function store(TransactionStoreRequest $request, Transactions $transactions)
    {
        $transaction = $transactions->create($request->user(), $request->validated());

        event(new NewTransaction($transaction));
        $request->session()->flash('status', 'Balance entry saved successfully.');

        return redirect()->route('dashboard');
    }
}
