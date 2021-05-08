<?php

namespace App\Services;

use App\Models\Entry;
use Illuminate\Database\Eloquent\Collection;

class TotalBalanceCalculator
{
    /**
     * @param Collection|Entry[] $entries
     * @return float
     */
    public function calculateBalance(iterable $entries): float
    {
        $total = 0;
        foreach ($entries as $entry) {
            // avoid floating point arithmetic
            $value = (int)($entry->value * 100);
            if (!$entry->is_debit) {
                $value *= -1;
            }
            $total += $value;
        }
        $total = $total / 100;

        return $total;
    }
}
