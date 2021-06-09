<?php

namespace App\Http\Repositories;

use Illuminate\Support\Facades\Storage;
use League\Csv\Reader;
use League\Csv\Statement;

class CsvRepository
{
    public function upload($file)
    {
        try {
            $savedFile = Storage::putFileAs("imported", $file, uniqid() . ".csv");
            if (!$savedFile) {
                return false;
            }
            $path = $this->getPath($savedFile);
            return [
                'filePath' => $path,
                'count' => $this->countRows($path),
            ];
        } catch (\Exception $e) {
            //handle
        }
    }

    public function getPath($file)
    {
        return Storage::path($file);
    }

    public function countRows($file)
    {
        $reader = Reader::createFromPath($file, 'r');
        $records = Statement::create()->process($reader);
        return count($records);
    }
}
