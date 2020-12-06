<?php

namespace App\Repositories;

use App\Models\Transaction;
use App\Models\User;
use Illuminate\Support\Carbon;

class Transactions
{
    public function getRecentGrouped(User $user, $limit = 100, $offset = 0): array
    {
        $transactions = Transaction::query()
            ->where('user_id', $user->id)
            ->orderBy('occurred_at', 'desc')
            ->limit($limit)
            ->offset($offset)
            ->get();

        $grouped = [];

        foreach ($transactions as $transaction) {
            $date = Carbon::createFromTimeString($transaction->occurred_at)
                ->format('D, d M');

            if ($date === Carbon::today()->format('D, d M')) {
                $date = 'Today';
            } elseif ($date === Carbon::yesterday()->format('D, d M')) {
                $date = 'Yesterday';
            }

            $grouped[$date][] = $transaction;
        }

        return $grouped;
    }

    public function getCurrentBalance(User $user)
    {
        return $user->transactions->sum('amount');
    }

    public function create(User $user, array $data): Transaction
    {
        $transaction = new Transaction();

        $transaction->user_id = $user->id;
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
