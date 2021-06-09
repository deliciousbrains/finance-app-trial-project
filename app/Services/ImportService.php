<?php

namespace App\Services;

use App\Http\Repositories\CsvRepository;
use App\Jobs\ProcessCsv;
use App\Events\CsvImportStartedEvent;
use App\Http\Controllers\CsvImportController;

class ImportService
{
    private CsvRepository $csvRepository;

    public function __construct(CsvRepository $csvRepository)
    {
        $this->csvRepository = $csvRepository;
    }

    public function handleUpload($file): array
    {
        try {
            $savedFile = $this->csvRepository->upload($file);
            if (!$savedFile) {
                //show error
                return [
                    "error" => "file upload error"
                ];
            }

            ProcessCsv::dispatch($savedFile['filePath']);

            CsvImportStartedEvent::dispatch($savedFile['count'] - 1);

            return [
                "success" => "Processing file"
            ];
        } catch (\Exception $e) {
            dd($e);
        }
    }
}
