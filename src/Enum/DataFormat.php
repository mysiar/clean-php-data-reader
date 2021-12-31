<?php

declare(strict_types=1);

namespace App\Enum;

use App\Exception\DataFormatException;

enum DataFormat: string
{
    case JSON = 'json';
    case XML = 'xml';
    case CSV = 'csv';

    /** @throws */
    public static function getDataFormat(string $format): self
    {
        return match (strtolower($format)) {
            'json' => self::JSON,
            'xml' => self::XML,
            'csv' => self::CSV,
            default => throw DataFormatException::formatNotSupported($format),
        };
    }
}
