<?php

namespace App\Services;

use App\Models\Account;
use App\Http\Resources\AccountResource;

use Illuminate\Support\Facades\Log;

class AccountService
{
    public function getAllWithProcessedTransactions($account_id): AccountResource
    {
        return new AccountResource(Account::where('id', $account_id)->first());
    }

    public function calculateBalance($account_id)
    {
        $account = Account::findOrFail($account_id);
        $runningBalance = $account->transactions()->processed()->sum('value');

        $account->balance = $runningBalance;
        $account->save();
    }
}
