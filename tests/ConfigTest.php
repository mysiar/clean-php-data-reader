<?php

declare(strict_types=1);

namespace App\Tests;

use App\Config;
use App\Enum\DataFormat;
use App\Exception\ConfigException;
use PHPUnit\Framework\TestCase;

class ConfigTest extends TestCase
{
    /**
     * @covers \App\Config::isFormatEnabled
     * @throws ConfigException
     */
    public function testIsFormatEnabled(): void
    {
        $filename = __DIR__ . '/data/config.yaml';
        $config = new Config($filename);

        $this->assertTrue($config->isFormatEnabled(DataFormat::JSON));
        $this->assertTrue($config->isFormatEnabled(DataFormat::XML));
        $this->assertFalse($config->isFormatEnabled(DataFormat::CSV));
    }

    /**
     * @covers \App\Config::__construct
     * @throws ConfigException
     */
    public function testCreateConfigThrowsOnFile(): void
    {
        $filename = __DIR__ . '/data/not-existing.yaml';

        $this->expectException(ConfigException::class);

        new Config($filename);
    }

    /**
     * @covers \App\Config::__construct
     * @throws ConfigException
     */
    public function testCreateConfigThrowsOnWrongConfigSection(): void
    {
        $filename = __DIR__ . '/data/config-wrong.yaml';

        $this->expectException(ConfigException::class);
        new Config($filename);
    }

    /**
     * @covers \App\Config::__construct
     * @throws ConfigException
     */
    public function testCreateConfigThrowsOnWrongYaml(): void
    {
        $filename = __DIR__ . '/data/config-wrong-yaml.yaml';

        $this->expectException(ConfigException::class);
        new Config($filename);
    }
}
