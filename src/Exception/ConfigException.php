<?php

declare(strict_types=1);

namespace App\Exception;

use App\Enum\DataFormat;
use Exception;

class ConfigException extends Exception
{
    public static function fileNotExists(string $filename): self
    {
        return new self(sprintf("Config file doesn't exist: %s.", $filename));
    }

    public static function sectionNotExists(string $section): self
    {
        return new self(sprintf("Config section doesn't exist: %s.", $section));
    }

    public static function wrongYaml(string $filename): self
    {
        return new self(sprintf("Config file wrong YAML : %s.", $filename));
    }

    public static function formatDisabled(DataFormat $format): self
    {
        return new self(sprintf('Format "%s" disabled in config.', DataFormat::string($format)));
    }
}
