<?php

namespace App\Services;

use App\Models\Entry;
use Illuminate\Database\Eloquent\Collection;

class EntryGrouper
{
    /**
     * @param Collection|Entry[] $entries
     * @return array
     */
    public function groupByDate(iterable $entries): array
    {
        $days = [];
        $groupedEntries = [];
        // this code operates on the premise that entries are sorted by date
        foreach ($entries as $entry) {
            $day = $entry->date->format('Y-m-d');
            if (!in_array($day, $days)) {
                $days[] = $day;
                $isToday = false;
                $isYesterday = false;
                if ($entry->date->isToday()) {
                    $isToday = true;
                }
                if ($entry->date->isYesterday()) {
                    $isYesterday = true;
                }
                $groupedEntries[] = [
                    'day' => $day,
                    'is_today' => $isToday,
                    'is_yesterday' => $isYesterday,
                    'sum' => 0,
                    'entries' => [$entry->toArray()],
                ];
            } else {
                $groupedEntries[sizeof($groupedEntries) - 1]['entries'][] = $entry->toArray();
            }
        }
        foreach ($groupedEntries as &$day) {
            $daySum = 0;
            foreach ($day['entries'] as $entry) {
                $daySum += $entry['value'];
            }
            $day['sum'] = $daySum;
        }
        return $groupedEntries;
    }
}
