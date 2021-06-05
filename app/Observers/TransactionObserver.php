<?php

namespace App\Observers;

use App\Models\Transaction;

class TransactionObserver
{

    public function saved(Transaction $transaction)
    {
        $account = $transaction->account()->find($transaction->account_id);
        $runningBalance = $transaction->sum('value');

        $account->balance = $runningBalance;
        $account->save();
    }
}
