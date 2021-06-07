<?php

namespace App\Services;

use App\Http\Repositories\CsvRepository;

class ImportService
{
    private CsvRepository $csvRepository;

    public function __construct(CsvRepository $csvRepository)
    {
        $this->csvRepository = $csvRepository;
    }

    public function handleUpload($file)
    {
        return $this->csvRepository->upload($file);
    }
}
