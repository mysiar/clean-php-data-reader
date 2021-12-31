<?php

declare(strict_types=1);

namespace App\Tests\Enum;

use App\Enum\DataFormat;
use App\Exception\DataFormatException;
use PHPUnit\Framework\TestCase;

class DataFormatTest extends TestCase
{
    /**
     * @covers \App\Enum\DataFormat::getDataFormat
     *
     * @throws
     */
    public function testGetDataFormat(): void
    {
        $this->assertEquals(DataFormat::JSON, DataFormat::getDataFormat('json'));
        $this->assertEquals(DataFormat::JSON, DataFormat::getDataFormat('JsoN'));
        $this->assertEquals(DataFormat::XML, DataFormat::getDataFormat('xml'));
        $this->assertEquals(DataFormat::CSV, DataFormat::getDataFormat('csv'));

        $this->expectException(DataFormatException::class);
        $this->expectExceptionMessage('Unsupported format type: txt !');
        DataFormat::getDataFormat('txt');
    }

    /**
     * @covers \App\Enum\DataFormat::getString
     */
    public function testGetString(): void
    {
        $this->assertEquals('json', DataFormat::getString(DataFormat::JSON));
        $this->assertEquals('xml', DataFormat::getString(DataFormat::XML));
        $this->assertEquals('csv', DataFormat::getString(DataFormat::CSV));
    }
}
