<?php


namespace App\Service\Stream;


use Exception;

class CsvReader extends Reader
{
    /** @inheritDoc */
    public function read(string $fileName) : array
    {
        if (!file_exists($fileName)) {
            throw new Exception("File $fileName not exists");
        }

        $csv = [];
        if (($handler = fopen($fileName, 'r')) !== false) {
            while (($line = fgetcsv($handler, null, ';', "\"", "\"")) !== false) {
                $csv[] = $line;
            }
            fclose($handler);
        } else {
            throw new Exception("Can't open file, may be file not found or permission denied");
        }

        return $csv;
    }
}