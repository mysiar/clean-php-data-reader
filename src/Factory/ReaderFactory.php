<?php

declare(strict_types=1);

namespace App\Factory;

use App\Config;
use App\Enum\DataFormat;
use App\Exception\ConfigException;
use App\Reader\CsvReader;
use App\Reader\JsonReader;
use App\Reader\ReaderInterface;
use App\Reader\XmlReader;
use SplFileObject;

class ReaderFactory
{
    private Config $config;

    public function __construct(Config $config)
    {
        $this->config = $config;
    }

    /**
     * @throws
     */
    public function create(string $filename): ReaderInterface
    {
        $file = new SplFileObject($filename);

        $format = DataFormat::getDataFormat($file->getExtension());

        if (! $this->config->isFormatEnabled($format)) {
            throw ConfigException::formatDisabled($format);
        }

        return match ($format) {
            DataFormat::JSON => new JsonReader($file),
            DataFormat::XML => new XmlReader($file),
            DataFormat::CSV => new CsvReader($file),
        };
    }
}
