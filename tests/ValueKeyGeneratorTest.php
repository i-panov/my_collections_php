<?php

namespace My\Collections\Tests;

use My\Collections\Impl\ValueKeyGenerator;
use PHPUnit\Framework\TestCase;

class ValueKeyGeneratorTest extends TestCase
{
    public function testGenerateKey(): void
    {
        $generator = new ValueKeyGenerator();

        $this->assertEquals('#int:0', $generator->generateKey(0));
        $this->assertEquals('#int:123', $generator->generateKey(123));
        $this->assertEquals(hex2bin('23666c6f61743a77be9f1a2fdd5e40'), $generator->generateKey(123.456));
        $this->assertEquals('#bool:true', $generator->generateKey(true));
        $this->assertEquals('#bool:false', $generator->generateKey(false));
        $this->assertEquals('#null#', $generator->generateKey(null));
        $this->assertEquals('#string:foo', $generator->generateKey('foo'));
        $this->assertEquals('#arr:#int:1|#int:2|#int:3', $generator->generateKey([1, 2, 3]));
    }
}
