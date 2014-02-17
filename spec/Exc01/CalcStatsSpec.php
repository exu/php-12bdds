<?php

namespace spec\Exc01;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class CalcStatsSpec extends ObjectBehavior
{
    protected $data = [3,3,4,5,6,99,-99,7,8,64];

    function it_is_initializable()
    {
        $this->shouldHaveType('Exc01\CalcStats');
    }

    function it_throws_exception_on_empty_array_input()
    {
        $this->shouldThrow(new \InvalidArgumentException('You cannot pass empty array'))
            ->duringCollect([]);
    }


    function it_calculates_min_from_given_integers()
    {
        $this->collect($this->data)
            ->shouldHaveElement('min', -99);
    }

    function it_calculates_max_from_given_integers()
    {
        $this->collect($this->data)
            ->shouldHaveElement('max', 99);
    }

    function it_calculates_avg_from_given_integers()
    {
        $this->collect($this->data)
            ->shouldHaveElement('avg', 10.0);
    }

    function it_calculates_count_from_given_integers()
    {
        $this->collect($this->data)
            ->shouldHaveElement('count', 10);
    }


    public function getMatchers()
    {
        $matchers = [
            'haveElement' => function($result, $key, $value) {
                return  isset($result[$key]) && $result[$key] === $value;
            }
        ];

        return $matchers;
    }

}
