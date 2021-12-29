<?php

declare(strict_types=1);

namespace App\Tests;

use App\Config;
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

        $this->assertTrue($config->isFormatEnabled('json'));
        $this->assertTrue($config->isFormatEnabled('xml'));
        $this->assertFalse($config->isFormatEnabled('csv'));
    }

    /**
     * @covers \App\Config::isFormatEnabled
     * @throws ConfigException
     */
    public function testIsFormatEnabledThrows(): void
    {
        $filename = __DIR__ . '/data/config.yaml';
        $config = new Config($filename);

        $this->expectException(ConfigException::class);
        $this->expectExceptionMessage('Unsupported format type: txt.');
        $config->isFormatEnabled('txt');
    }

    /**
     * @covers \App\Config::__construct
     * @throws ConfigException
     */
    public function testCreateConfigThrowsOnFile(): void
    {
        $filename = __DIR__ . '/data/not-existing.yaml';

        $this->expectException(ConfigException::class);
        $this->expectExceptionMessage("Config file doesn't exist: /var/www/tests/data/not-existing.yaml.");
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
        $this->expectExceptionMessage("Config section doesn't exist: formats");
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
        $this->expectExceptionMessage("Config file wrong YAML : /var/www/tests/data/config-wrong-yaml.yaml.");
        new Config($filename);
    }
}
