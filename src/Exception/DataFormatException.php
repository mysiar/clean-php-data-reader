<?php

declare(strict_types=1);

namespace App\Exception;

use Exception;

class DataFormatException extends Exception
{
    public static function formatNotSupported(string $format): self
    {
        return new self(sprintf("Unsupported format type: %s !", $format));
    }
}
