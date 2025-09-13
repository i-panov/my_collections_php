<?php

namespace My\Collections\Interfaces;

interface IValueKeyGenerator
{
    /**
     * Generates a key for the given value.
     *
     * @param mixed $value The value to generate a key for.
     * @return string The generated key.
     */
    public function generateKey($value): string;
}
