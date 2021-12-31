<?php

declare(strict_types=1);

namespace App\Enum;

enum DataFormat: string
{
    case JSON = 'json';
    case XML = 'xml';
    case CSV = 'csv';

    public static function string(DataFormat $format): string
    {
        return match ($format) {
            self::JSON => 'json',
            self::XML => 'xml',
            self::CSV => 'csv',
        };
    }
}
