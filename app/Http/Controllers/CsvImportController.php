<?php

namespace App\Http\Controllers;

use App\Http\Requests\ImportFileRequest;
use App\Services\ImportService;

class CsvImportController extends Controller
{
    public function store(ImportFileRequest $request, ImportService $importService)
    {
        $validated = $request->validated();

        $path = $importService->handleUpload($validated['file']);

        return json_encode(['key' => $path]);
    }
}
