<?php

namespace App\Http\Controllers;

use App\Http\Resources\AccountResource;
use App\Services\AccountService;
use Illuminate\Support\Facades\Auth;

class AccountController extends Controller
{
    private AccountService $accountService;

    public function __construct(AccountService $accountService)
    {
        $this->accountService = $accountService;
    }

    public function index()
    {
        try {
            $user = Auth::user();
            $account_id = $user->accounts()->first()->id;

            return $this->accountService->getAllWithProcessedTransactions($account_id);
        } catch (\Exception $e) {
            // handle exception
        }
    }
}
