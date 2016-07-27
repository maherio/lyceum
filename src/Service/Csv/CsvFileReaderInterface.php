<?php

namespace Maherio\Lyceum\Service\Csv;

interface CsvFileReaderInterface {
    public function read(string $filepath);
}
