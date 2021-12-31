<?php

declare(strict_types=1);

namespace App\Tests\Enum;

use App\Enum\DataFormat;
use PHPUnit\Framework\TestCase;
use ValueError;

class DataFormatTest extends TestCase
{
    /**
     * @covers \App\Enum\DataFormat::from
     *
     * @throws
     */
    public function testGetDataFormat(): void
    {
        $this->assertEquals(DataFormat::JSON, DataFormat::from('json'));
        $this->assertEquals(DataFormat::XML, DataFormat::from('xml'));
        $this->assertEquals(DataFormat::CSV, DataFormat::from('csv'));

        $this->expectException(ValueError::class);
        DataFormat::from('txt');
    }

    /**
     * @covers \App\Enum\DataFormat::string
     */
    public function testGetString(): void
    {
        $this->assertEquals('json', DataFormat::string(DataFormat::JSON));
        $this->assertEquals('xml', DataFormat::string(DataFormat::XML));
        $this->assertEquals('csv', DataFormat::string(DataFormat::CSV));
    }
}
