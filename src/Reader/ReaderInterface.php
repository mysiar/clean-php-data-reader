<?php

declare(strict_types=1);

namespace App\Reader;

interface ReaderInterface
{
    public const TYPE_JSON = 'json';

    public const TYPE_CSV = 'csv';

    public const TYPE_XML = 'xml';

    public function read(): array;
}
