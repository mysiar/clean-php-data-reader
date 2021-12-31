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
    public function testGetYearQuarter(): void
    {
        $this->assertEquals(DataFormat::JSON, DataFormat::getDataFormat('json'));
        $this->assertEquals(DataFormat::JSON, DataFormat::getDataFormat('JsoN'));
        $this->assertEquals(DataFormat::XML, DataFormat::getDataFormat('xml'));
        $this->assertEquals(DataFormat::CSV, DataFormat::getDataFormat('csv'));

        $this->expectException(DataFormatException::class);
        $this->expectExceptionMessage('Unsupported format type: txt !');
        DataFormat::getDataFormat('txt');
    }
}
