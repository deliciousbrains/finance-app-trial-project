<?php

namespace App\Http\Controllers;

use App\Jobs\ImportBulkTransactions;
use App\Repositories\BulkProcesses;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class BulkImportController extends Controller
{
    public function store(Request $request, BulkProcesses $bulkProcesses): RedirectResponse
    {
        $file = $request->file('bulk');

        if (strtoupper($file->getClientOriginalExtension()) !== 'CSV') {
            session()->flash('error', 'Sorry, only CSV file type is supported at this moment.');

            return response()->redirectToRoute('dashboard');
        }

        $path = storage_path('app/') . $file->storeAs('imports', $file->getClientOriginalName());

        $bulkProcess = $bulkProcesses->create($path);
        $this->dispatch(new ImportBulkTransactions($bulkProcess));

        return response()->redirectToRoute('dashboard');
    }
}
