<?php

namespace App\Jobs;

use App\Models\BulkProcess;
use App\Models\Transaction;
use App\Support\CSV;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Carbon;

class ImportBulkTransactions implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @var BulkProcess
     */
    private $bulkProcess;

    /**
     * Create a new job instance.
     *
     * @param BulkProcess $bulkProcess
     */
    public function __construct(BulkProcess $bulkProcess)
    {
        $this->bulkProcess = $bulkProcess;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $entries = CSV::toArray($this->bulkProcess->filename);

        \DB::beginTransaction();

        foreach ($entries as $entry) {
            Transaction::create([
                'user_id' => $this->bulkProcess->user->id,
                'label' => $entry['Label'],
                'amount' => $entry['Value'],
                'occurred_at' => Carbon::createFromTimeString($entry['Date'])->format('Y-m-d H:i:s')
            ]);
        }

        \DB::commit();

        $this->bulkProcess->completed = true;
        $this->bulkProcess->save();
    }
}
