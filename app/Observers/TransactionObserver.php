<?php

namespace App\Observers;

use App\Models\Transaction;
use Illuminate\Support\Facades\Log;

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
        $account = $transaction->account()->first();
        $runningBalance = $transaction->processed()->sum('value');

        $account->balance = $runningBalance;
        $account->save();
    }
}
