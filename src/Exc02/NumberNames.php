<?php

namespace Exc02;

class NumberNames
{
    protected $predefined = [
        0 =>   'zero',
        1 =>   'one',
        2 =>   'two',
        3 =>   'three',
        4 =>   'four',
        5 =>   'five',
        6 =>   'six',
        7 =>   'seven',
        8 =>   'eight',
        9 =>   'nine',
        10 =>  'ten',
        11 =>  'eleven',
        12 =>  'twelve',
        13 =>  'thirteen',
        14 =>  'fourteen',
        15 =>  'fifteen',
        16 =>  'sixteen',
        17 =>  'seventeen',
        18 =>  'eighteen',
        19 =>  'nineteen',
        20 =>  'twenty',
        30 =>  'thirty',
        40 =>  'forty',
        50 =>  'fifty',
        60 =>  'sixty',
        70 =>  'seventy',
        80 =>  'eighty',
        90 =>  'ninety',
        100 => 'hundred',
    ];

    protected $divisors = [
        1000 =>          'thousand',
        1000000 =>       'million',
        1000000000 =>    'billion',
        1000000000000 => 'billiard',
    ];


    protected function findDivisor($number)
    {
        $divisor = 1;
        for (;;) {
            $divisor *= 1000;
            if ($divisor > $number) {
                return (int) ($divisor / 1000);
            }
        }
    }

    protected function divideNumber($number)
    {
        $result = [];
        $divisor = $this->findDivisor($number);

        for (;;) {
            if ($divisor === 0) {
                return $result;
            }

            $value = (int) ($number / $divisor);
            $result[] = ['divisor' => $divisor, 'value' => $value];

            $number = $number - ($divisor * $value);
            $divisor = (int) ($divisor / 1000);
        }

        return $result;
    }

    protected function spellHundrets($number)
    {
        $hundreds = (int) ($number / 100);
        $tens = $number % 100;
        $spelled = '';

        if ($number === 0) {
            return '';
        }

        if ($hundreds > 0) {
            $spelled .= $this->predefined[$hundreds] .  ' hundred';
        }

        if ($hundreds > 0 && $tens > 0) {
            $spelled .= ' and ';
        }

        if ($tens > 0) {
            $spelled .= $this->spellTens($tens);
        }

        return $spelled ;
    }

    function spellTens($number)
    {
        if (isset($this->predefined[$number])) {
            return $this->predefined[$number];
        }

        $spelled = '';
        $ten = 10 * (int)($number / 10);
        $one = $number % 10;

        if ($ten > 0) {
            $spelled .= $this->predefined[$ten];
            if ($one > 0) {
                $spelled .= ' ';
            }
        }

        if ($one > 0) {
            $spelled .= $this->predefined[$one];
        }

        return $spelled;
    }

    public function spell($number)
    {
        if (isset($this->predefined[$number])) {
            return $this->predefined[$number];
        }

        if ($number < 100) {
            return $this->spellTens($number);
        }

        $divided = $this->divideNumber($number);
        $spelled = [];

        for ($i = 0; $i < count($divided); $i++) {
            $divisor = $divided[$i]['divisor'];
            $num = $divided[$i]['value'];

            $div = $divisor > 1 ? ' ' . $this->divisors[$divisor] : '';

            if (isset($this->predefined[$num])) {
                $sub = $this->predefined[$num];
            } else {
                $sub = $this->spellHundrets($num);
            }

            $spelled[] = $sub . $div;
        }

        return implode(', ', $spelled);
    }
}
