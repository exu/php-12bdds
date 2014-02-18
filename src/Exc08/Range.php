<?php

namespace Exc08;

class Range
{
    protected $values;

    public function __construct($min = null, $max = null)
    {
        if (!empty($min) && !empty($max)) {
            $this->create($min, $max);
        }
    }

    public function contains($number)
    {
        return (array_search($number, $this->values) !== false);
    }

    public function create($from, $to, $step = 1)
    {
        $this->values = [];

        for ($i = $from; $i < $to; $i += $step) {
            $this->values[] = $i;
        }
    }

    public function getValues()
    {
        return $this->values;
    }

}
