<?php

namespace Maherio\Lyceum\Service\Csv;

use League\Csv\Reader;

$csv = Reader::createFromPath('/path/to/your/csv/file.csv');

class CsvFileReader implements CsvFileReaderInterface {
    public function read(string $filepath) {
        //create csv reader
        $reader = Reader::createFromPath($filepath);

        //create associative array from csv
        return $reader->fetchAll();
    }
}
