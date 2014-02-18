<?php

namespace Exc08;

class FloatRange extends Range
{
    public function create($from, $to, $step = 1)
    {
        return parent::create((float) $from, (float) $to, (float) $step);
    }

    function intersect(Range $range)
    {
        $values = $this->getValues();
        $rangeValues = $range->getValues();

        $min = min($values);
        $min = $min > min($rangeValues) ? $min : min($rangeValues);

        $max = max($values);
        $max = $max < max($rangeValues) ? $max : max($rangeValues);

        $joined = array_merge($values, $rangeValues);

        $out = [];
        foreach($joined as $value) {
            if ($value >= $min && $value <= $max) {
                $out[] = $value;
            }
        }

        return array_unique($out);
    }
}
