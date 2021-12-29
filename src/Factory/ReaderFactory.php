<?php

declare(strict_types=1);

namespace App\Factory;

use App\Config;
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
        $ext = strtolower($file->getExtension());

        if (! $this->config->isFormatEnabled($ext)) {
            throw ConfigException::formatDisabled($ext);
        }

        return match ($ext) {
            ReaderInterface::TYPE_JSON => new JsonReader($file),
                ReaderInterface::TYPE_XML => new XmlReader($file),
                ReaderInterface::TYPE_CSV => new CsvReader($file),
        };
    }
}
