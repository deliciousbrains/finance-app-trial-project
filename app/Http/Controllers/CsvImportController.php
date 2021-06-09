<?php

namespace App\Http\Controllers;

use App\Http\Requests\ImportFileRequest;
use App\Services\ImportService;

class CsvImportController extends Controller
{
    public function store(ImportFileRequest $request, ImportService $importService)
    {
        $validated = $request->validated();

        $message = $importService->handleUpload($validated['file']);

        return json_encode($message);
    }
}
