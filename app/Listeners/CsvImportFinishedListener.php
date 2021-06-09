<?php

namespace App\Listeners;

use App\Events\CsvImportFinishedEvent;
use App\Services\TransactionService;
use App\Services\AccountService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class CsvImportFinishedListener implements ShouldQueue
{
    use InteractsWithQueue;

    public $afterCommit = true;
    private $transactionService;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(TransactionService $transactionService, AccountService $accountService)
    {
        $this->transactionService = $transactionService;
        $this->accountService = $accountService;
    }

    /**
     * Handle the event.
     *
     * @param  CsvImportFinishedEvent  $event
     * @return void
     */
    public function handle(CsvImportFinishedEvent $event)
    {
        $this->transactionService->updateAfterImport($event->jobParent);
        $this->accountService->calculateBalance(1);
    }
}
