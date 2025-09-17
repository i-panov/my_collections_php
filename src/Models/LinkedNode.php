<?php

namespace My\Collections\Models;

class LinkedNode extends SingleNode
{
    private ?self $prev;

    /**
     * Initializes a new instance of the LinkedNode class.
     *
     * @param mixed $value The value of this node.
     * @param self|null $next The next node in the list, or null if this is the last node.
     * @param self|null $prev The previous node in the list, or null if this is the first node.
     */
    public function __construct($value, ?self $next, ?self $prev) {
        parent::__construct($value, $next);
        $this->prev = $prev;
    }

    /**
     * Gets the previous node in the list.
     *
     * @return self|null The previous node in the list, or null if this is the first node.
     */
    public function getPrev(): ?self {
        return $this->prev;
    }
}
