<?php

namespace My\Collections\Impl;

use My\Collections\Interfaces\ICollection;
use My\Collections\Interfaces\IValueChecker;
use Traversable;

abstract class BaseCollection implements ICollection
{
    protected array $items = [];

    protected ?IValueChecker $valueChecker;

    public function __construct(?IValueChecker $valueChecker = null) {
        $this->valueChecker = $valueChecker;
    }

    protected function checkValue($value)
    {
        if ($this->valueChecker) {
            if ($e = $this->valueChecker->check($value)) {
                throw $e;
            }
        }
    }

    protected function checkCallback(callable $callback): callable
    {
        $r = new \ReflectionFunction($callback);
        $n = $r->getNumberOfParameters();

        if ($n < 1) {
            throw new \InvalidArgumentException('Callback must have at least 1 parameter.');
        }

        $needKey = $n === 2;

        return function($value, $key) use ($callback, $needKey) {
            $args = [$value];

            if ($needKey) {
                $args[] = $key;
            }

            return call_user_func_array($callback, $args);
        };
    }

    public function isEmpty(): bool
    {
        return empty($this->items);
    }

    public function any(callable $callback): bool
    {
        return $this->countBy($callback) > 0;
    }

    public function all(callable $callback): bool
    {
        return $this->countBy($callback) === $this->count();
    }

    public function count(bool $recursive = false): int
    {
        return count($this->items, $recursive ? COUNT_RECURSIVE : COUNT_NORMAL);
    }

    public function countOf($item, bool $strict = false): int
    {
        $this->checkValue($item);
        $result = 0;

        foreach ($this->items as $value) {
            $isEquals = $strict ? $value === $item : $value == $item;

            if ($isEquals) {
                $result++;
            }
        }

        return $result;
    }

    public function countBy(callable $callback): int
    {
        $callback = $this->checkCallback($callback);
        $result = 0;

        foreach ($this->items as $key => $value) {
            if ($callback($value, $key)) {
                $result++;
            }
        }

        return $result;
    }

    public function jsonSerialize(): array
    {
        return $this->items;
    }

    public function clear(): bool
    {
        if ($this->items) {
            $this->items = [];
            return true;
        }

        return false;
    }
}
