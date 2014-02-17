<?php

namespace Exc02;

class NumberNames
{
    protected $ones = [
        0 => 'zero',
        1 => 'one',
        2 => 'two',
        3 => 'three',
        4 => 'four',
        5 => 'five',
        6 => 'six',
        7 => 'seven',
        8 => 'eight',
        9 => 'nine',
    ];

    protected $tens = [
        0 => '',
        1 => 'ten',
        2 => 'twenty',
        3 => 'thirty',
        4 => 'forty',
        5 => 'fifty',
        6 => 'sixty',
        7 => 'seventy',
        8 => 'eighty',
        9 => 'ninety',
    ];

    protected $teens = [
        0 => 'ten',
        1 => 'eleven',
        2 => 'twelve',
        3 => 'thirteen',
        4 => 'fourteen',
        5 => 'fivetenn',
        6 => 'sixteen',
        7 => 'seventeen',
        8 => 'eightteen',
        9 => 'nineteen',
    ];

    protected $multiples = [
        0 => '',
        3 => 'thousand',
        6 => 'million',
        9 => 'billion',
    ];

    public function spell($number)
    {
        $number = strrev((float) $number);

        $words = $multiplier = '';
        $nums = str_split($number);

        for ($i = count($nums)-1; $i >= 0; $i--) {

            $n = $nums[$i];
            $nm1 = isset($nums[$i-1]) ? $nums[$i-1] : 0;
            $nm2 = isset($nums[$i-2]) ? $nums[$i-2] : 0;
            $np1 = isset($nums[$i+1]) ? $nums[$i+1] : 0;

            $multiplier = isset($this->multiples[$i]) ? $this->multiples[$i] : $multiplier;

            switch ($i % 3) {
                case 0:
                    if ($np1 == 1 || ($n == 0 && count($nums) > 1) ) {
                        $word = '';
                        break;
                    }
                    $word = $this->ones[$n];
                    break;
                case 1:
                    if ($n == 1) {
                        $word = $this->teens[$nm1];
                    } else {
                        $word = $this->tens[$n];
                    }
                    break;
                case 2:
                    $word = $this->ones[$n] . ' hundred';
                    if ($nm1 || $nm2) {
                        $word .= ' and'; // f*** british
                    }
                    break;
            }

            if ($word) {
                $words[] = $word;
            }

            if (isset($this->multiples[$i]) && $i > 1) {
                $words[] =  $this->multiples[$i] . ',';
            }
        }

        return implode(' ', $words);
    }
}
