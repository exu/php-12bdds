<?php

namespace Exc01;

class CalcStats
{
    public function collect(array $input)
    {
        if (empty($input)) {
            throw new \InvalidArgumentException('You cannot pass empty array');
        }

        $result = [
            'min' => min($input),
            'max' => max($input),
            'count' => count($input),
            'avg' => array_sum($input) / (float) count($input),
        ];
        return $result;
    }
}
