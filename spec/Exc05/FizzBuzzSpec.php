<?php

namespace spec\Exc05;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

/**
 *  Write a program that prints the numbers from 1 to 100. But for multiples of
 *  three print “Fizz” instead of the number and for the multiples of five
 *  print “Buzz”. For numbers which are multiples of both three and five print
 *  “FizzBuzz”.
 */

class FizzBuzzSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Exc05\FizzBuzz');
    }

    function it_prints_number()
    {
        $this->get(2)->shouldBe(2);
        $this->get(1)->shouldBe(1);
    }

    function it_prints_fizz_on_mod3()
    {
        $this->get(3)->shouldBe('Fizz');
        $this->get(9)->shouldBe('Fizz');
        $this->get(99)->shouldBe('Fizz');
    }

    function it_prints_buzz_on_mod3()
    {
        $this->get(5)->shouldBe('Buzz');
        $this->get(10)->shouldBe('Buzz');
        $this->get(20)->shouldBe('Buzz');
    }

    function it_prints_fizzbuzz_on_mod3_and_mod5()
    {
        $this->get(15)->shouldBe('FizzBuzz');
        $this->get(30)->shouldBe('FizzBuzz');
        $this->get(45)->shouldBe('FizzBuzz');
    }

    function it_prints_correct_numbers_from_1_to_100()
    {
        $expected = '1 2 Fizz 4 Buzz Fizz 7 8 Fizz Buzz ' .
            '11 Fizz 13 14 FizzBuzz 16 17 Fizz 19 Buzz ' .
            'Fizz 22 23 Fizz Buzz 26 Fizz 28 29 FizzBuzz ' .
            '31 32 Fizz 34 Buzz Fizz 37 38 Fizz Buzz ' .
            '41 Fizz 43 44 FizzBuzz 46 47 Fizz 49 Buzz ' .
            'Fizz 52 53 Fizz Buzz 56 Fizz 58 59 FizzBuzz ' .
            '61 62 Fizz 64 Buzz Fizz 67 68 Fizz Buzz ' .
            '71 Fizz 73 74 FizzBuzz 76 77 Fizz 79 Buzz ' .
            'Fizz 82 83 Fizz Buzz 86 Fizz 88 89 FizzBuzz ' .
            '91 92 Fizz 94 Buzz Fizz 97 98 Fizz Buzz';

        $this->getFizzyBuzzyString()->shouldBeLike($expected);
    }

}
