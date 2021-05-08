<?php

namespace Tests\Unit;

use App\Models\Entry;
use App\Services\TotalBalanceCalculator;
use Tests\TestCase;

class TotalBalanceCalculatorTest extends TestCase
{
    public function testCalculateBalance()
    {
        $firstEntry = new Entry();
        $firstEntry->value = 5.40;
        $firstEntry->is_debit = true;
        $secondEntry = new Entry();
        $secondEntry->value = 18.35;
        $secondEntry->is_debit = false;
        $thirdEntry = new Entry();
        $thirdEntry->value = 2.28;
        $thirdEntry->is_debit = true;
        $entries = [$firstEntry, $secondEntry, $thirdEntry];

        $totalBalanceCalculator = new TotalBalanceCalculator();
        $result = $totalBalanceCalculator->calculateBalance($entries);
        $this->assertEquals(-10.68, $result);
    }
}
