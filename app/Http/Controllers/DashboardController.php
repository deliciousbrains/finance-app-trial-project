<?php

namespace App\Http\Controllers;

use App\Repositories\Transactions;
use Illuminate\Http\JsonResponse;

class DashboardController extends Controller
{
    public function index(Transactions $transactions)
    {
        return view('dashboard', [
            'groupedTransactions' => $transactions->getRecentGrouped(),
            'currentBalance' => $transactions->getCurrentBalance()
        ]);
    }

    public function balance(Transactions $transactions): JsonResponse
    {
        return response()->json([
            'balance' => $transactions->getCurrentBalance()
        ]);
    }
}
