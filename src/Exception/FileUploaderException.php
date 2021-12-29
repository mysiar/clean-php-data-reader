<?php

declare(strict_types=1);

namespace App\Exception;

use Exception;

class FileUploaderException extends Exception
{
    public static function noFile(): self
    {
        return new self(sprintf("There is no file to process."));
    }

    public static function cantMove(): self
    {
        return new self(sprintf("Can't move file."));
    }
}
