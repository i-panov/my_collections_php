<?php

namespace My\Collections\Tests;

use My\Collections\Impl\ArraySet;
use PHPUnit\Framework\TestCase;

class ArraySetTest extends TestCase
{
    public function testArraySet(): void
    {
        $set = new ArraySet();
        $set->addAll([1, 2, 2, 3]);

        $this->assertEquals([1, 2, 3], $set->jsonSerialize());
        $this->assertEquals(3, $set->count());

        $set->remove(2);
        $this->assertFalse($set->contains(2));

        $set->clear();
        $this->assertTrue($set->isEmpty());
    }
}
