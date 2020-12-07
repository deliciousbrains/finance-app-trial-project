<?php

namespace App\Http\Controllers;

use App\Jobs\ImportBulkTransactions;
use App\Repositories\BulkProcesses;
use Illuminate\Http\Request;

class BulkImportController extends Controller
{
    public function store(Request $request, BulkProcesses $bulkProcesses)
    {
        $file = $request->file('bulk');
        $path = storage_path('app/') . $file->storeAs('imports', $file->getClientOriginalName());

        $bulkProcess = $bulkProcesses->create($path);
        $this->dispatch(new ImportBulkTransactions($bulkProcess));

        return response()->redirectToRoute('dashboard');
    }
}
