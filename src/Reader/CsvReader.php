<?php

declare(strict_types=1);

namespace App\Reader;

use SplFileObject;

class CsvReader extends AbstractReader
{
    public function read(): array
    {
        $this->file->setCsvControl($delimiter = ',', $enclosure = '\'', $escape = '\\');
        $this->file->setFlags(
            SplFileObject::READ_CSV |
            SplFileObject::SKIP_EMPTY |
            SplFileObject::READ_AHEAD |
            SplFileObject::DROP_NEW_LINE
        );
        $raw = [];
        while (! $this->file->eof()) {
            $raw[] = $this->file->fgetcsv();
        }

        return $this->rawCsv2AssocArray($raw);
    }

    private function rawCsv2AssocArray($csv): array
    {
        $result = [];
        $headers = array_shift($csv);
        $fieldCount = count($headers);
        foreach ($csv as $record) {
            if (is_array($record) && count($record) === $fieldCount) {
                $item = [];
                for ($i = 0; $i < $fieldCount; $i++) {
                    $item[$headers[$i]] = $record[$i];
                }
                $result[] = $item;
            }
        }

        return $result;
    }
}
