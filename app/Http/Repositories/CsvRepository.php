<?php

namespace App\Http\Repositories;

use Illuminate\Support\Facades\Storage;

class CsvRepository
{
    public function upload($file)
    {
        $path = Storage::putFileAs("imported", $file, uniqid() . ".csv");

        return $path;
    }
}
