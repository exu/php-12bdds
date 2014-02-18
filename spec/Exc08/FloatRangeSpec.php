<?php

namespace spec\Exc08;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class FloatRangeSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Exc08\FloatRange');
        $this->shouldBeAnInstanceOf('Exc08\Range');
    }

    function it_generates_range_of_floats($min, $max)
    {
        $this->create(0, 1, 0.2);
        $this->getValues()->shouldHaveCount(5);
    }

    function it_checks_if_contains_an_integer()
    {
        $this->create(0.0, 1.0, 0.2);
        $this->contains(0.0)->shouldReturn(true);
        $this->contains(0.8)->shouldReturn(true);
        $this->contains(0.4)->shouldReturn(true);
        $this->contains(-0.1)->shouldReturn(false);
        $this->contains(11.1)->shouldReturn(false);
        $this->contains(9999)->shouldReturn(false);
    }


    function it_intersects_two_ranges(\Exc08\IntRange $range)
    {
        $range->getValues()->willReturn([0.2, 0.4, 0.6]);
        $this->create(0.6, 1.0, 0.2);
        $this->intersect($range)->shouldBe([0.6]);
    }

}
