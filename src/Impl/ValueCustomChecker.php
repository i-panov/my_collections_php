<?php

namespace My\Collections\Impl;

use My\Collections\Interfaces\IValueChecker;

/**
 * Checks if the given value is valid.
 * For example: is_int, is_float, is_string, etc.
 */
class ValueCustomChecker implements IValueChecker
{
    /** @var callable */
    private $callback;

    public function __construct(callable $callback)
    {
        $this->callback = $callback;
    }

    public function check($value): ?\Throwable
    {
        if (call_user_func($this->callback, $value)) {
            return null;
        }

        return new \InvalidArgumentException("Invalid value");
    }
}
