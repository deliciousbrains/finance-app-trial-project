<?php

namespace App\Observers;

use App\Models\Transaction;

class TransactionObserver
{
    public function deleted(Transaction $transaction)
    {
        $this->updateBalance($transaction);
    }

    public function saved(Transaction $transaction)
    {
        $this->updateBalance($transaction);
    }

    private function updateBalance(Transaction $transaction)
    {
        $account = $transaction->account()->find($transaction->account_id);
        $runningBalance = $transaction->sum('value');

        $account->balance = $runningBalance;
        $account->save();
    }
}
