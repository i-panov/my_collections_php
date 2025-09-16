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

    public function any(callable $callback): bool;

    public function all(callable $callback): bool;

    public function count(bool $recursive = false): int;

    public function countOf($item, bool $strict = false): int;

    public function countBy(callable $callback): int;

    /**
     * Returns a JSON serializable representation of the collection.
     *
     * @return array A JSON serializable representation of the collection.
     */
    public function jsonSerialize(): array;

    /**
     * Removes all items from the set.
     *
     * @return bool True if the set had any items to remove, false otherwise.
     */
    public function clear(): bool;
}
