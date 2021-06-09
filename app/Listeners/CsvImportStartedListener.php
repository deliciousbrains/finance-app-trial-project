<?php

namespace App\Listeners;

use App\Events\CsvImportStartedEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;

class CsvImportStartedListener
{
    /**
     * Handle the event.
     *
     * @param  CsvImportStartedEvent  $event
     * @return void
     */
    public function handle(CsvImportStartedEvent $event)
    {
        // nothing to handle atm
    }
}
