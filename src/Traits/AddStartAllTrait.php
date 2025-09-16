<?php

namespace My\Collections\Traits;

trait AddStartAllTrait
{
    public abstract function addStart($item): bool;

    public function addStartAll(iterable $items): void
    {
        foreach ($items as $item) {
            $this->addStart($item);
        }
    }
}
