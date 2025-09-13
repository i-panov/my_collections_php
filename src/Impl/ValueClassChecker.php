<?php

namespace My\Collections\Impl;

use My\Collections\Interfaces\IValueChecker;

class ValueClassChecker implements IValueChecker
{
    private string $itemClass;

    public function __construct(string $itemClass)
    {
        if (!class_exists($itemClass)) {
            throw new \InvalidArgumentException("Item class $itemClass not found");
        }

        $this->itemClass = $itemClass;
    }

    public function check($value): ?\Throwable
    {
        if ($value instanceof $this->itemClass) {
            return null;
        }

        return new \InvalidArgumentException("Invalid item class");
    }
}
