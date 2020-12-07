<?php

namespace App\Repositories;

use App\Models\BulkProcess;
use Illuminate\Support\Facades\Auth;

class BulkProcesses
{
    public function create(string $filename): BulkProcess
    {
        $user = Auth::user();

        $bulkProcess = new BulkProcess();
        $bulkProcess->user_id = $user->id;
        $bulkProcess->filename = $filename;
        $bulkProcess->record_count = $this->getLineCount($filename);
        $bulkProcess->completed = false;

        $bulkProcess->save();

        return $bulkProcess;
    }

    private function getLineCount($file): int
    {
        $file = new \SplFileObject($file, 'r');
        $file->setFlags(\SplFileObject::READ_AHEAD | \SplFileObject::SKIP_EMPTY | \SplFileObject::DROP_NEW_LINE);
        $file->seek(PHP_INT_MAX);

        return $file->key();
    }
}
