<?php

namespace Exc05;

class FizzBuzz
{
    public function get($in)
    {
        $out = '';

        if ($in % 3 === 0) {
            $out .= 'Fizz';
        }

        if ($in % 5 === 0) {
            $out .= 'Buzz';
        }

        if (!$out) {
            $out = $in;
        }

        return $out;
    }



    public function getFizzyBuzzyString()
    {
        $out = '';
        for ($i = 1; $i <= 100; $i++) {
            $out .= $this->get($i) . ($i < 100 ? ' ' : '');
        }

        return $out;
    }
}
