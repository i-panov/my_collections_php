<?php

namespace My\Collections\Traits;

trait AddAllTrait
{
    public abstract function add($item): bool;

    public function addAll(iterable $items): void
    {
        foreach ($items as $item) {
            $this->add($item);
        }
    }
}
