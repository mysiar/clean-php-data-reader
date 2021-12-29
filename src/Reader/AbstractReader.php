<?php

declare(strict_types=1);

namespace App\Reader;

use SplFileObject;

abstract class AbstractReader implements ReaderInterface
{
    protected SplFileObject $file;

    public function __construct(SplFileObject $file)
    {
        $this->file = $file;
    }
}
