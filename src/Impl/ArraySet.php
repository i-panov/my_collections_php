<?php

namespace My\Collections\Impl;

use My\Collections\Interfaces\ISet;
use My\Collections\Interfaces\IValueChecker;
use My\Collections\Interfaces\IValueKeyGenerator;
use My\Collections\Traits\AddAllTrait;

class ArraySet extends BaseCollection implements ISet
{
    use AddAllTrait;

    private IValueKeyGenerator $valueKeyGenerator;

    public function __construct(?IValueChecker $valueChecker = null, ?IValueKeyGenerator $valueKeyGenerator = null)
    {
        parent::__construct($valueChecker);
        $this->valueKeyGenerator = $valueKeyGenerator ?? new ValueKeyGenerator();
    }

    /**
     * @inheritDoc
     */
    public function getIterator()
    {
        foreach ($this->items as $value) {
            yield $value;
        }
    }

    public function add($item): bool
    {
        $this->checkValue($item);
        $key = $this->valueKeyGenerator->generateKey($item);

        if (!isset($this->items[$key])) {
            $this->items[$key] = $item;
            return true;
        }

        return false;
    }

    public function remove($item): bool
    {
        $key = $this->valueKeyGenerator->generateKey($item);

        if (isset($this->items[$key])) {
            unset($this->items[$key]);
            return true;
        }

        return false;
    }

    public function contains($item): bool
    {
        $key = $this->valueKeyGenerator->generateKey($item);
        return isset($this->items[$key]);
    }

    public function jsonSerialize(): array
    {
        return array_values($this->items);
    }
}
