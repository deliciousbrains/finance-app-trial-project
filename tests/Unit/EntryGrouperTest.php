<?php

namespace Tests\Unit;

use App\Models\Entry;
use App\Services\EntryGrouper;
use Carbon\Carbon;
use Tests\TestCase;

class EntryGrouperTest extends TestCase
{
    public function testGroupByDate()
    {
        $today = Carbon::now()->format('Y-m-d');
        $yesterday = Carbon::now()->subDay()->format('Y-m-d');


        $firstEntry = new Entry();
        $firstEntry->id = 1;
        $firstEntry->date = new Carbon('2020-05-09');
        $secondEntry = new Entry();
        $secondEntry->id = 2;
        $secondEntry->date = Carbon::now();
        $thirdEntry = new Entry();
        $thirdEntry->id = 3;
        $thirdEntry->date = Carbon::now()->subDay();
        $fourthEntry = new Entry();
        $fourthEntry->id = 4;
        $fourthEntry->date = new Carbon('2020-11-12 09:30:00');
        $fifthEntry = new Entry();
        $fifthEntry->id = 5;
        $fifthEntry->date = Carbon::now()->subDay();
        $entries = [$firstEntry, $secondEntry, $thirdEntry, $fourthEntry, $fifthEntry];

        $entryGrouper = new EntryGrouper();
        $result = $entryGrouper->groupByDate($entries);
        $expectedKeys = [
            $today,
            $yesterday,
            '2020-11-12',
            '2020-05-09',
        ];
        $this->assertEquals($expectedKeys, array_keys($result));

        $this->assertEquals(1, sizeof($result[$today]));
        $this->assertEquals(2, $result[$today][0]['id']);
        $this->assertTrue($result[$today][0]['is_today']);
        $this->assertFalse($result[$today][0]['is_yesterday']);

        $this->assertEquals(2, sizeof($result[$yesterday]));
        $this->assertEquals(3, $result[$yesterday][0]['id']);
        $this->assertFalse($result[$yesterday][0]['is_today']);
        $this->assertTrue($result[$yesterday][0]['is_yesterday']);
        $this->assertEquals(5, $result[$yesterday][1]['id']);
        $this->assertFalse($result[$yesterday][1]['is_today']);
        $this->assertTrue($result[$yesterday][1]['is_yesterday']);

        $this->assertEquals(1, sizeof($result['2020-11-12']));
        $this->assertEquals(4, $result['2020-11-12'][0]['id']);
        $this->assertFalse($result['2020-11-12'][0]['is_today']);
        $this->assertFalse($result['2020-11-12'][0]['is_yesterday']);

        $this->assertEquals(1, sizeof($result['2020-05-09']));
        $this->assertEquals(1, $result['2020-05-09'][0]['id']);
        $this->assertFalse($result['2020-05-09'][0]['is_today']);
        $this->assertFalse($result['2020-05-09'][0]['is_yesterday']);
    }
}
