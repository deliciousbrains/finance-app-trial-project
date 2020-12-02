<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $transactions = $request->user()->transactions()
            ->orderByDesc('performed_at')
            ->get()
            // Make it play nice with the datetime picker:
            ->map(function ($item) {
                $item->performed_at = \Carbon\Carbon::parse($item->performed_at)->toIso8601String();
                return $item;
            })
            ->groupBy(function ($item) {
                return explode('T', $item->performed_at)[0];
            });
        return view('dashboard', [
            'transactions' => $transactions,
        ]);
    }
}
