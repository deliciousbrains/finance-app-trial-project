<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use League\Csv\Reader;
use App\Jobs\ProcessCsvRow;
use App\Services\TransactionService;
use App\Events\CsvImportFinishedEvent;

class ProcessCsv implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable;

    private $file;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($file)
    {
        $this->file = $file;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(TransactionService $transactionService)
    {
        $jobId = $this->job->getJobId();
        $reader = Reader::createFromPath($this->file, 'r');
        $records = $reader->getRecords();
        foreach ($records as $record) {
            if ($record[0] === 'Label') {
                continue;
            }
            ProcessCsvRow::dispatchSync($record, $jobId);
        }
        
        CsvImportFinishedEvent::dispatch($jobId);
    }
}
