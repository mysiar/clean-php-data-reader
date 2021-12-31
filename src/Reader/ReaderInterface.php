<?php

declare(strict_types=1);

namespace App\Reader;

interface ReaderInterface
{
    public function read(): array;
}
