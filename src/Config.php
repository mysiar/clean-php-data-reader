<?php

declare(strict_types=1);

namespace App;

use App\Exception\ConfigException;
use RuntimeException;
use SplFileObject;

class Config
{
    public const FORMATS = 'formats';

    private array $formats;

    /**
     * @throws
     */
    public function __construct(string $filename)
    {
        try {
            $file = new SplFileObject($filename);
        } catch (RuntimeException $e) {
            throw ConfigException::fileNotExists($filename);
        }

        $config = yaml_parse($file->fread($file->getSize()));

        if (! is_array($config)) {
            throw ConfigException::wrongYaml($filename);
        }

        if (! array_key_exists(self::FORMATS, $config)) {
            throw ConfigException::sectionNotExists(self::FORMATS);
        }

        $this->formats = $config[self::FORMATS];
    }

    /**
     * Checks if format is enabled in config - returns bool
     * if format is not listed in the config throws exception
     *
     * @throws
     */
    public function isFormatEnabled(string $format): bool
    {
        $format = strtolower($format);

        if (! array_key_exists($format, $this->formats)) {
            throw ConfigException::formatNotSupported($format);
        }

        return (bool) $this->formats[$format];
    }
}
