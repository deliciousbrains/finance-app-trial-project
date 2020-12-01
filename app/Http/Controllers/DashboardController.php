<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $transactions = $request->user()->transactions->sortByDesc('performed_at');
        return view('dashboard', [
            'transactions' => $transactions->groupBy(function ($item) {
                return explode(' ', $item->performed_at)[0];
            }),
        ]);
    }
}
