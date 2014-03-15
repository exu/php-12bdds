<?php

namespace spec\Exc02;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

/**
 *  Spell out a number. For example
 *
 *  99 → ninety nine
 *  300 → three hundred
 *  310 → three hundred and ten
 *  1501 → one thousand, five hundred and one
 *  12609 → twelve thousand, six hundred and nine
 *  512607 → five hundred and twelve thousand,
 *  six hundred and seven
 *  43112603 → forty three million, one hundred and
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

    protected $tens = [
        11 => 'eleven',
        22 => 'twenty two',
        31 => 'thirty one',
        43 => 'forty three',
        56 => 'fifty six',
        64 => 'sixty four',
        78 => 'seventy eight',
        85 => 'eighty five',
        98 => 'ninety eight',
        99 => 'ninety nine'
    ];

    protected $hundreds = [
        544 => 'five hundred and forty four',
        987 => 'nine hundred and eighty seven',
        110 => 'one hundred and ten',
        211 => 'two hundred and eleven',
        1 =>   'one',
        13 =>  'thirteen',
    ];

    protected $tousands = [
        898982332876 => 'eight hundred and ninety eight billion, nine hundred and eighty two million, three hundred and thirty two thousand, eight hundred and seventy six',
        32876 =>        'thirty two thousand, eight hundred and seventy six',
        1544 =>         'one thousand, five hundred and forty four',
        2987 =>         'two thousand, nine hundred and eighty seven',
        2011 =>         'two thousand, eleven',
        2211 =>         'two thousand, two hundred and eleven',
        3110 =>         'three thousand, one hundred and ten',
    ];

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

    function it_is_initializable()
    {
        $this->shouldHaveType('Exc02\NumberNames');
    }

    function it_spells_predefined()
    {
        foreach ($this->predefined as $num => $name) {
            $this->spell($num)->shouldBe($name);
        }
    }

    function it_spells_tens()
    {
        foreach ($this->tens as $num => $name) {
            $this->spell($num)->shouldBe($name);
        }
    }

    function it_spells_hundreds()
    {
        foreach ($this->hundreds as $num => $name) {
            $this->spell($num)->shouldBe($name);
        }
    }

    function it_spells_tousands()
    {
        foreach ($this->tousands as $num => $name) {
            $this->spell($num)->shouldBe($name);
        }
    }

    function it_converts_numbers_to_their_names()
    {
        foreach ($this->data as $number => $name) {
            $this->spell($number)->shouldBe($name);
        }
    }
}
