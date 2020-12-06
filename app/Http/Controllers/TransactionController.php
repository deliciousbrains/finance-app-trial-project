<?php

namespace App\Http\Controllers;

use App\Http\Requests\TransactionStoreRequest;
use App\Models\Transaction;
use App\Repositories\Transactions;

class TransactionController extends Controller
{
    public function store(TransactionStoreRequest $request, Transactions $transactions)
    {
        $transactions->create($request->user(), $request->validated());

        $request->session()->flash('status', 'Balance entry saved successfully.');

        return redirect()->route('dashboard');
    }

    public function update(Transaction $transaction, TransactionStoreRequest $request, Transactions $transactions)
    {
        $transactions->update($transaction, $request->validated());

        return response('OK');
    }

    public function destroy(Transaction $transaction, Transactions $transactions)
    {
        $transactions->delete($transaction);

        return response('OK');
    }
}
