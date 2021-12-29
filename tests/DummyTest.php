<?php

declare(strict_types=1);

namespace App\Tests;

use PHPUnit\Framework\TestCase;

class DummyTest extends TestCase
{
    /**
     * @covers
     */
    public function test(): void
    {
        $this->assertFalse(false);
    }
}
