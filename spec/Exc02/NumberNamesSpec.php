<?php

namespace spec\Exc02;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

/**
 *  Spell out a number. For example
 *
 *  99 –> ninety nine
 *  300 –> three hundred
 *  310 –> three hundred and ten
 *  1501 –> one thousand, five hundred and one
 *  12609 –> twelve thousand, six hundred and nine
 *  512607 –> five hundred and twelve thousand,
 *  six hundred and seven
 *  43112603 –> forty three million, one hundred and
 *  twelve thousand,
 *  six hundred and three
 */
class NumberNamesSpec extends ObjectBehavior
{
    protected $data = [
        0 => 'zero',
        9 => 'nine',
        12 => 'twelve',
        99 => 'ninety nine',
        123 => 'one hundred and twenty three',
        300 => 'three hundred',
        310 => 'three hundred and ten',
        1501 => 'one thousand, five hundred and one',
        12609 => 'twelve thousand, six hundred and nine',
        512607 => 'five hundred and twelve thousand, six hundred and seven',
        43112603 => 'forty three million, one hundred and twelve thousand, six hundred and three',
        5143112603 => 'five billion, one hundred and forty three million, one hundred and twelve thousand, six hundred and three',
    ];

    function it_is_initializable()
    {
        $this->shouldHaveType('Exc02\NumberNames');
    }

    function it_converts_numbers_to_their_names()
    {
        foreach ($this->data as $number => $name) {
            $this->spell($number)->shouldBe($name);
        }
    }
}
