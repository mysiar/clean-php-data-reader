<?php

declare(strict_types=1);

namespace App\Reader;

class JsonReader extends AbstractReader
{
    public function read(): array
    {
        return json_decode($this->file->fread($this->file->getSize()), true);
    }
}
