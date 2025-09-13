<?php

namespace My\Collections\Impl;

use My\Collections\Interfaces\IValueKeyGenerator;

class ValueKeyGenerator implements IValueKeyGenerator
{

    public function generateKey($value): string
    {
        if (is_iterable($value)) {
            $result = [];

            foreach ($value as $item) {
                $result[] = $this->generateKey($item);
            }

            return '#arr:' . implode('|', $result);
        } elseif (is_object($value)) {
            return (string)spl_object_id($value);
        } elseif (is_bool($value)) {
            return '#bool:' . ($value ? 'true' : 'false');
        } elseif (is_null($value)) {
            return '#null#';
        } elseif (is_resource($value)) {
            return '#resource:' . get_resource_type($value) . ':' . (int)$value;
        } elseif (is_float($value)) {
            return '#float:' . pack('d', $value);
        } elseif (is_int($value)) {
            return '#int:' . $value;
        } elseif (is_string($value)) {
            return '#string:' . $value;
        }

        return '#unknown:' . gettype($value) . ':' . $value;
    }
}
