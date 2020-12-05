<?php

namespace App\Http\Controllers;

use App\Repositories\Transactions;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request, Transactions $transactions)
    {
        $user = $request->user();

        return view('dashboard', [
            'groupedTransactions' => $transactions->getRecentGrouped($user),
            'currentBalance' => $transactions->getCurrentBalance($user)
        ]);
    }
}
