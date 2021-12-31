<?php

declare(strict_types=1);

namespace App\Tests\Factory;

use App\Config;
use App\Exception\ConfigException;
use App\Exception\DataFormatException;
use App\Factory\ReaderFactory;
use App\Reader\CsvReader;
use App\Reader\JsonReader;
use App\Reader\XmlReader;
use PHPUnit\Framework\TestCase;

class ReaderFactoryTest extends TestCase
{
    private ReaderFactory $factory;

    /**
     * @covers \App\Factory\ReaderFactory::create
     * @throws ConfigException
     */
    public function testCreate(): void
    {
        $configFilename = __DIR__ . '/../data/config-all-enabled.yaml';
        $config = new Config($configFilename);
        $this->factory = new ReaderFactory($config);

        $filename = __DIR__ . '/../data/data.json';
        $reader = $this->factory->create($filename);
        $this->assertInstanceOf(JsonReader::class, $reader);

        $filename = __DIR__ . '/../data/data.xml';
        $reader = $this->factory->create($filename);
        $this->assertInstanceOf(XmlReader::class, $reader);

        $filename = __DIR__ . '/../data/data.csv';
        $reader = $this->factory->create($filename);
        $this->assertInstanceOf(CsvReader::class, $reader);
    }

    /**
     * @covers \App\Factory\ReaderFactory::create
     * @throws ConfigException
     */
    public function testCreateThrows(): void
    {
        $configFilename = __DIR__ . '/../data/config-all-enabled.yaml';
        $config = new Config($configFilename);
        $this->factory = new ReaderFactory($config);

        $filename = __DIR__ . '/../data/data.txt';

        $this->expectException(DataFormatException::class);
        $this->expectExceptionMessage('Unsupported format type: txt !');
        $this->factory->create($filename);
    }

    /**
     * @covers \App\Factory\ReaderFactory::create
     * @throws ConfigException
     */
    public function testCreateThrowsFormatDisabled(): void
    {
        $configFilename = __DIR__ . '/../data/config.yaml';
        $config = new Config($configFilename);
        $this->factory = new ReaderFactory($config);

        $filename = __DIR__ . '/../data/data.csv';

        $this->expectException(ConfigException::class);
        $this->expectExceptionMessage('Format "csv" disabled in config.');
        $this->factory->create($filename);
    }
}
