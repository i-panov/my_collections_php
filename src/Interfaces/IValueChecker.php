<?php

namespace My\Collections\Interfaces;

interface IValueChecker
{
    /**
     * Checks if the given value is valid.
     *
     * @param mixed $value The value to check.
     *
     * @return \Throwable|null If the value is invalid, returns an exception, otherwise null.
     */
    public function check($value): ?\Throwable;
}
