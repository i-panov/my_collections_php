<?php

namespace My\Collections\Impl;

use My\Collections\Interfaces\IList;
use My\Collections\Interfaces\IValueChecker;
use My\Collections\Traits\AddAllTrait;
use My\Collections\Traits\AddStartAllTrait;

class ArrayList extends BaseCollection implements IList
{
    use AddAllTrait, AddStartAllTrait;

    private bool $throwOnOutOfBounds;

    public function __construct(bool $throwOnOutOfBounds = true, ?IValueChecker $valueChecker = null)
    {
        parent::__construct($valueChecker);
        $this->throwOnOutOfBounds = $throwOnOutOfBounds;
    }

    /**
     * @inheritDoc
     */
    public function getIterator() {
        return new \ArrayIterator($this->items);
    }

    /**
     * @inheritDoc
     */
    public function offsetExists($offset): bool
    {
        if (!$this->checkIndex($offset)) {
            return false;
        }

        return isset($this->items[$offset]);
    }

    /**
     * @inheritDoc
     */
    public function offsetGet($offset)
    {
        if (!$this->checkIndex($offset)) {
            return null;
        }

        return $this->items[$offset];
    }

    /**
     * @inheritDoc
     */
    public function offsetSet($offset, $value)
    {
        $this->checkValue($value);

        if ($this->checkIndex($offset)) {
            $this->items[$offset] = $value;
        }
    }

    /**
     * @inheritDoc
     */
    public function offsetUnset($offset)
    {
        if ($this->checkIndex($offset)) {
            unset($this->items[$offset]);
        }
    }

    // todo: any, all, countOf($item), map, reduce, filter, sort

    private function checkIndex($index): bool
    {
        if (!is_int($index)) {
            throw new \InvalidArgumentException('Index must be an integer.');
        }

        if ($index < 0) {
            if (!$this->throwOnOutOfBounds) {
                return false;
            }

            throw new \InvalidArgumentException('Index must be non-negative.');
        }

        if ($index >= $this->count()) {
            if (!$this->throwOnOutOfBounds) {
                return false;
            }

            throw new \OutOfRangeException('Index is out of range.');
        }

        return true;
    }

    public function add($item): bool
    {
        $this->checkValue($item);
        $this->items[] = $item;
        return true;
    }

    public function remove($item): bool
    {
        $this->checkValue($item);
        $index = $this->find($item);

        if ($index < 0) {
            return false;
        }

        unset($this->items[$index]);
        return true;
    }

    public function contains($item, bool $strict = false): bool
    {
        $this->checkValue($item);
        return in_array($item, $this->items, $strict);
    }

    public function find($item, bool $strict = false): int
    {
        $this->checkValue($item);
        return array_search($item, $this->items, $strict);
    }

    public function findBy(callable $callback): int
    {
        foreach ($this->items as $index => $item) {
            if ($callback($item, $index)) {
                return $index;
            }
        }

        return -1;
    }

    public function addStart($item): bool
    {
        $this->checkValue($item);
        array_unshift($this->items, $item);
        return true;
    }

    public function removeAt(int $index): bool
    {
        if (!$this->checkIndex($index)) {
            return false;
        }

        unset($this->items[$index]);
        return true;
    }
}
