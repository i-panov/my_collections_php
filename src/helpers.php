<?php

namespace My\Collections;

use My\Collections\Impl\ArraySet;
use My\Collections\Interfaces\ISet;

function makeSet(iterable $items): ISet
{
    $result = new ArraySet();
    $result->addAll($items);
    return $result;
}
