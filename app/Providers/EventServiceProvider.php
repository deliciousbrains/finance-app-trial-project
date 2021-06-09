<?php

namespace App\Providers;

use App\Models\Transaction;
use App\Observers\TransactionObserver;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;
use App\Events\CsvImportStartedEvent;
use App\Events\CsvImportFinishedEvent;
use App\Listeners\CsvImportStartedListener;
use App\Listeners\CsvImportFinishedListener;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        CsvImportStartedEvent::class => [
            CsvImportStartedListener::class,
        ],
        CsvImportFinishedEvent::class => [
            CsvImportFinishedListener::class
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        Transaction::observe(TransactionObserver::class);
    }
}
