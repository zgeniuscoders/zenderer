<?php 

namespace Zgeniuscoders\Zenderer\Tests;

use PHPUnit\Framework\TestCase;

class ZendererTest extends TestCase{
    public function testGreetsWithName(): void
    {
        $greeting = "Hello, Alice!";

        $this->assertSame('Hello, Alice!', $greeting);
    }

}