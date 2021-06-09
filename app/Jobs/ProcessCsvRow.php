<?php

namespace App\Jobs;

use App\Services\TransactionService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ProcessCsvRow implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $record;
    private $jobParent;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($record, $jobParent)
    {
        $this->record = $record;
        $this->jobParent = $jobParent;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(TransactionService $transactionService)
    {
        //hardcoded the account no. as not present in csv data
        $transactionService->import([
            'account_id' => 1,
            'label' => $this->record[0],
            'value' => $this->record[1],
            'date' => $this->record[2],
            'processed' => 0,
            'jobid' => $this->jobParent,
        ]);
    }
}
