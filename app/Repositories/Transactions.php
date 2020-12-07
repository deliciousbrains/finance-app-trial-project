<?php

namespace App\Repositories;

use App\Models\Transaction;
use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class Transactions
{
    public function getRecentGrouped(): array
    {
        $user = Auth::user();

        $transactions = Transaction::query()
            ->where('user_id', $user->id)
            ->orderBy('occurred_at', 'desc')
            ->limit(10)
            ->get();

        $grouped = [];

        foreach ($transactions as $transaction) {
            $date = Carbon::createFromTimeString($transaction->occurred_at)
                ->format('D, d M');

            $year = Carbon::createFromTimeString($transaction->occurred_at)
                ->format('Y');

            if ($year === Carbon::today()->format('Y')) {
                if ($date === Carbon::today()->format('D, d M')) {
                    $group = 'Today';
                } elseif ($date === Carbon::yesterday()->format('D, d M')) {
                    $group = 'Yesterday';
                } else {
                    $group = $date;
                }
            } else {
                $group = $year;
            }

            $grouped[$group][] = $transaction;
        }

        return $grouped;
    }

    public function getCurrentBalance()
    {
        $user = Auth::user();

        return $user->transactions->sum('amount');
    }

    public function create(User $user, array $data): Transaction
    {
        $transaction = new Transaction();

        $transaction->user_id = Auth::user()->id;
        $transaction->label = $data['label'];
        $transaction->amount = $data['amount'];
        $transaction->occurred_at = Carbon::createFromTimeString($data['occurred_at'])->format('Y-m-d H:i:s');

        $transaction->save();

        return $transaction;
    }

    public function update(Transaction $transaction, array $data): Transaction
    {
        $transaction->label = $data['label'];
        $transaction->amount = $data['amount'];
        $transaction->occurred_at = Carbon::createFromTimeString($data['occurred_at'])->format('Y-m-d H:i:s');

        $transaction->save();

        return $transaction;
    }

    public function delete(Transaction $transaction)
    {
        $transaction->delete();
    }
}
