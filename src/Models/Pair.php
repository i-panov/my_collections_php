<?php

namespace My\Collections\Models;

class Pair
{
    /** @var mixed */
    private $key;

    /** @var mixed */
    private $value;

    public function __construct($key, $value) {
        $this->key = $key;
        $this->value = $value;
    }

    public function getKey() {
        return $this->key;
    }

    public function getValue() {
        return $this->value;
    }
}
