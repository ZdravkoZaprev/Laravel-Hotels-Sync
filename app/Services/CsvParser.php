<?php

namespace App\Services;

use App\Interfaces\ParserInterface;
use League\Csv\Reader;

class CsvParser implements ParserInterface
{
    public function parse(string $filePath, ?string $delimiter = null): array
    {
        $csv = Reader::createFromPath($filePath, 'r');
        $csv->setHeaderOffset(0);

        if ($delimiter) {
            $csv->setDelimiter($delimiter);
        }

        $records = $csv->getRecords();

        $data = [];
        foreach ($records as $record) {
            $data[] = $record;
        }

        return $data;
    }
}
