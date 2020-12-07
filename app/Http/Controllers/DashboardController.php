<?php

namespace App\Http\Controllers;

use App\Repositories\Transactions;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request, Transactions $transactions)
    {
        return view('dashboard', [
            'groupedTransactions' => $transactions->getRecentGrouped(),
            'currentBalance' => $transactions->getCurrentBalance()
        ]);
    }

    public function balance(Request $request, Transactions $transactions)
    {
        $user = $request->user();

        return response()->json([
            'balance' => $transactions->getCurrentBalance()
        ]);
    }
}
