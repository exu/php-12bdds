<?php

namespace Exc08;

class IntRange extends Range
{
    function intersect(Range $range)
    {
        $values = $this->getValues();
        $rangeValues = $range->getValues();

        return array_intersect($values, $rangeValues);
    }
}
