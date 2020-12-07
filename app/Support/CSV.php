<?php

namespace App\Support;

class CSV
{
    public static function toArray(string $filename, string $delimiter = ','): array
    {
        ini_set("auto_detect_line_endings", true);

        if (!file_exists($filename) || !is_readable($filename)) {
            throw new \RuntimeException("Cannot read the file ($filename).");
        }

        $header = null;
        $data = [];

        if (($handle = fopen($filename, 'r')) !== false) {
            while (($row = fgetcsv($handle, 1000, $delimiter)) !== false) {
                if (!$header) {
                    $header = $row;
                } else {
                    $data[] = array_combine($header, $row);
                }
            }

            fclose($handle);
        }

        return $data;
    }
}
