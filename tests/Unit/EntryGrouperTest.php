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
        $firstEntry->id = 2;
        $firstEntry->date = Carbon::now();
        $firstEntry->value = 60;
        $secondEntry = new Entry();
        $secondEntry->id = 3;
        $secondEntry->date = Carbon::now()->subDay();
        $secondEntry->value = -30;
        $thirdEntry = new Entry();
        $thirdEntry->id = 5;
        $thirdEntry->date = Carbon::now()->subDay();
        $thirdEntry->value = 80;
        $fourthEntry = new Entry();
        $fourthEntry->id = 4;
        $fourthEntry->date = new Carbon('2020-11-12 09:30:00');
        $fourthEntry->value = -100;
        $fifthEntry = new Entry();
        $fifthEntry->id = 1;
        $fifthEntry->date = new Carbon('2020-05-09');
        $fifthEntry->value = 300;
        $entries = [$firstEntry, $secondEntry, $thirdEntry, $fourthEntry, $fifthEntry];

        $entryGrouper = new EntryGrouper();
        $result = $entryGrouper->groupByDate($entries);
        $expected = [
            [
                'day' => $today,
                'is_today' => true,
                'is_yesterday' => false,
                'sum' => 60.0,
                'entries' => [
                    [
                        'id' => 2,
                        'value' => 60.0,
                    ],
                ],
            ],
            [
                'day' => $yesterday,
                'is_today' => false,
                'is_yesterday' => true,
                'sum' => 50.0,
                'entries' => [
                    [
                        'id' => 3,
                        'value' => -30.0,
                    ],
                    [
                        'id' => 5,
                        'value' => 80.0,
                    ],
                ],
            ],
            [
                'day' => '2020-11-12',
                'is_today' => false,
                'is_yesterday' => false,
                'sum' => -100.0,
                'entries' => [
                    [
                        'id' => 4,
                        'date' => '2020-11-12T09:30:00.000000Z',
                        'value' => -100.0,
                    ],
                ],
            ],
            [
                'day' => '2020-05-09',
                'is_today' => false,
                'is_yesterday' => false,
                'sum' => 300.0,
                'entries' => [
                    [
                        'id' => 1,
                        'date' => '2020-05-09T00:00:00.000000Z',
                        'value' => 300.0,
                    ],
                ],
            ],
        ];
        unset($result[0]['entries'][0]['date']);
        unset($result[1]['entries'][0]['date']);
        unset($result[1]['entries'][1]['date']);
        $this->assertEquals($expected, $result);
    }
}
