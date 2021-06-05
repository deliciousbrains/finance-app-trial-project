<?php

namespace App\Services;

use App\Models\Account;
use App\Http\Resources\AccountResource;

class AccountService
{
    public function getAllWithTransactions($account_id): AccountResource
    {
        return new AccountResource(Account::with('transactions')->where('id', $account_id)->first());
    }
}
