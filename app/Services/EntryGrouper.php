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
        $groupedEntries = [];
        foreach ($entries as $entry) {
            $day = $entry->date->format('Y-m-d');
            $isToday = false;
            $isYesterday = false;
            if ($entry->date->isToday()) {
                $isToday = true;
            }
            if ($entry->date->isYesterday()) {
                $isYesterday = true;
            }
            $modifiedEntry = $entry;
            $modifiedEntry['is_today'] = $isToday;
            $modifiedEntry['is_yesterday'] = $isYesterday;
            $groupedEntries[$day][] = $modifiedEntry;
        }
        arsort($groupedEntries);
        return $groupedEntries;
    }
}
