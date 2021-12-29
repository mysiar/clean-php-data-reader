<?php

declare(strict_types=1);

namespace App\Tests\Reader;

use App\Reader\CsvReader;
use PHPUnit\Framework\TestCase;
use SplFileObject;

class CsvReaderTest extends TestCase
{
    private CsvReader $reader;

    public function setUp(): void
    {
        $this->reader = new CsvReader(new SplFileObject(__DIR__ . '/../data/data.csv'));
    }

    /**
     * @covers \App\Reader\CsvReader::read
     */
    public function testRead(): void
    {
        $result = $this->reader->read();
        $this->assertIsArray($result);

        foreach ($result as $r) {
            $this->assertArrayHasKey('First_name', $r);
            $this->assertNotNull($r['First_name']);
            $this->assertArrayHasKey('age', $r);
            $this->assertNotNull($r['age']);
            $this->assertArrayHasKey('gender', $r);
            $this->assertNotNull($r['gender']);
        }

        $this->assertEquals('Kestutis', $result[0]['First_name']);
        $this->assertEquals('29', $result[0]['age']);
        $this->assertEquals('male', $result[0]['gender']);
    }
}
