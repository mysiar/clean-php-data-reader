<?php

declare(strict_types=1);

namespace App\Tests\Reader;

use App\Reader\AbstractReader;
use App\Reader\ReaderInterface;
use App\Reader\XmlReader;
use PHPUnit\Framework\TestCase;
use SplFileObject;

class XmlReaderTest extends TestCase
{
    private XmlReader $reader;

    public function setUp(): void
    {
        $this->reader = new XmlReader(new SplFileObject(__DIR__ . '/../data/data.xml'));
    }

    /**
     * @covers
     */
    public function testImplementation(): void
    {
        $this->assertInstanceOf(AbstractReader::class, $this->reader);
        $this->assertInstanceOf(ReaderInterface::class, $this->reader);
    }

    /**
     * @covers \App\Reader\XmlReader::read
     */
    public function testRead(): void
    {
        $result = $this->reader->read();
        $this->assertIsArray($result);

        foreach ($result as $r) {
            $this->assertArrayHasKey('first_name', $r);
            $this->assertNotNull($r['first_name']);
            $this->assertArrayHasKey('age', $r);
            $this->assertNotNull($r['age']);
            $this->assertArrayHasKey('gender', $r);
            $this->assertNotNull($r['gender']);
        }

        $this->assertEquals('Kestutis', $result[0]['first_name']);
        $this->assertEquals('29', $result[0]['age']);
        $this->assertEquals('male', $result[0]['gender']);
    }
}
