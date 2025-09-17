<?php

namespace My\Collections\Models;

class SingleNode
{
    private $value;
    private ?self $next;

    /**
     * Initializes a new instance of the SingleNode class.
     *
     * @param mixed $value The value of this node.
     * @param self|null $next The next node in the list, or null if this is the last node.
     */
    public function __construct($value, ?self $next) {
        $this->value = $value;
        $this->next = $next;
    }

    /**
     * Gets the value of this node.
     *
     * @return mixed The value of this node.
     */
    public function getValue() {
        return $this->value;
    }

    /**
     * Gets the next node in the list.
     *
     * @return self|null The next node in the list, or null if this is the last node.
     */
    public function getNext(): ?self {
        return $this->next;
    }
}
