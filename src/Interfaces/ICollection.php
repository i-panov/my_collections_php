<?php

namespace My\Collections\Interfaces;

interface ICollection extends \IteratorAggregate, \Countable, \JsonSerializable
{
    /**
     * Checks if the collection is empty.
     *
     * @return bool True if the collection is empty, false otherwise.
     */
    public function isEmpty(): bool;

    /**
     * Returns a JSON serializable representation of the collection.
     *
     * @return array A JSON serializable representation of the collection.
     */
    public function jsonSerialize(): array;
}
