<?php

namespace My\Collections\Interfaces;

interface IList extends ICollection, IMutableCollection, \ArrayAccess
{
    public function find($item): int;

    public function findBy(callable $callback): int;

    public function addStart($item): bool;

    public function addStartAll(iterable $items): void;

    public function removeAt(int $index): bool;
}
