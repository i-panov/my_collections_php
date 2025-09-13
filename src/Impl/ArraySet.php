<?php

namespace My\Collections\Impl;

use My\Collections\Interfaces\ISet;
use My\Collections\Interfaces\IValueChecker;
use My\Collections\Interfaces\IValueKeyGenerator;

class ArraySet implements ISet
{
    private array $items = [];
    private ?IValueChecker $valueChecker;
    private IValueKeyGenerator $valueKeyGenerator;

    public function __construct(?IValueChecker $valueChecker = null, ?IValueKeyGenerator $valueKeyGenerator = null)
    {
        $this->valueChecker = $valueChecker;
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

    /**
     * @inheritDoc
     */
    public function count(): int
    {
        return count($this->items);
    }

    public function isEmpty(): bool
    {
        return empty($this->items);
    }

    public function add($item): bool
    {
        if ($this->valueChecker) {
            if ($e = $this->valueChecker->check($item)) {
                throw $e;
            }
        }

        $key = $this->valueKeyGenerator->generateKey($item);

        if (!isset($this->items[$key])) {
            $this->items[$key] = $item;
            return true;
        }

        return false;
    }

    public function addAll(iterable $items): void
    {
        foreach ($items as $item) {
            $this->add($item);
        }
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

    public function clear(): bool
    {
        if ($this->items) {
            $this->items = [];
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
