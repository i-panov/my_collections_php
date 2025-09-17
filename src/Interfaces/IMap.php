<?php

namespace My\Collections\Interfaces;

use My\Collections\Interfaces\ICollection;

interface IMap extends ICollection, \ArrayAccess
{
    public function get($key);

    public function set($key, $value);

    public function remove($key): bool;

    public function containsKey($key): bool;

    public function containsValue($value): bool;
}
