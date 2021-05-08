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
        $secondEntry = new Entry();
        $secondEntry->value = -18.35;
        $thirdEntry = new Entry();
        $thirdEntry->value = 2.28;
        $entries = [$firstEntry, $secondEntry, $thirdEntry];

        $totalBalanceCalculator = new TotalBalanceCalculator();
        $result = $totalBalanceCalculator->calculateBalance($entries);
        $this->assertEquals(-10.68, $result);
    }
}
