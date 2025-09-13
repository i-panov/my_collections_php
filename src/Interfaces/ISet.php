<?php

namespace My\Collections\Interfaces;

interface ISet extends ICollection
{
    /**
     * Adds an item to the set.
     *
     * If the set does not contain the item, adds it and returns true.
     * If the set already contains the item, does not modify the set and returns false.
     *
     * @param mixed $item The item to add to the set.
     * @return bool True if the item was added, false if the set already contained the item.
     */
    public function add($item): bool;

    /**
     * Adds all items from the given iterable to the set.
     *
     * For each item in the iterable, if the set does not contain the item, adds it and returns true.
     * If the set already contains the item, does not modify the set and returns false.
     *
     * @param iterable $items The iterable containing the items to add to the set.
     */
    public function addAll(iterable $items): void;

    /**
     * Removes an item from the set.
     *
     * If the set contains the item, removes it and returns true.
     * If the set does not contain the item, does not modify the set and returns false.
     *
     * @param mixed $item The item to remove from the set.
     * @return bool True if the item was removed, false if the set did not contain the item.
     */
    public function remove($item): bool;

    /**
     * Removes all items from the set.
     *
     * @return bool True if the set had any items to remove, false otherwise.
     */
    public function clear(): bool;

    /**
     * Determines whether the set contains the specified item.
     *
     * @param mixed $item The item to check for.
     * @return bool True if the set contains the item, false otherwise.
     */
    public function contains($item): bool;
}
