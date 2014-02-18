<?php

namespace spec\Exc08;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

/**
 * In mathematics we denote a range using open-closed bracket notation: [0,10)
 * means all real numbers equal to or greater than zero, but less than ten. So
 * 0 lies in this range, while 10 does not.
 *
 * 1. Develop an integer range class, that has the following operations:
 * Construction.
 * For example: r = new Range(0,10) // modify to fit your language's syntax
 * Checking whether an integer lies in the range.
 *
 * What name do you think is appropriate?  Intersection of two ranges,
 * creating a new range consisting of all integers that are in both ranges.
 *
 * For example, the intersection of range [0..3] (numbers 0, 1, 2 & 3) and
 * range [2..4] is the range [2..3] What do you think should happen if the
 * intersection is empty?  2. Develop another class to represent floating
 * point ranges, with the same operations.
 *
 * While developing the floating point range class, think about how it differs
 * from the integer range.  Is it possible to modify the behaviour of one of
 * them to become more consistent with the behaviour of the other? The more
 * uniform their behaviour, the easier the classes will be to use.  If you
 * modify one of the classes – do you feel confident you do not break
 * anything? If you don’t feel confident, what can you do about that?
 *
 */
class IntRangeSpec extends ObjectBehavior
{
    function it_is_initializable($min, $max)
    {
        $this->shouldHaveType('Exc08\IntRange');
        $this->shouldBeAnInstanceOf('Exc08\Range');
    }

    function it_generates_range_of_integers($min, $max)
    {
        $this->create(0, 10);
        $this->getValues()->shouldBe([0,1,2,3,4,5,6,7,8,9]);

        $this->create(0, 1);
        $this->getValues()->shouldBe([0]);
    }

    function it_checks_if_contains_an_integer()
    {
        $this->create(0, 10);
        $this->contains(9)->shouldReturn(true);
        $this->contains(0)->shouldReturn(true);
        $this->contains(5)->shouldReturn(true);
        $this->contains(-1)->shouldReturn(false);
        $this->contains(10)->shouldReturn(false);
        $this->contains(999)->shouldReturn(false);
    }


    function it_intersects_two_ranges(\Exc08\IntRange $range)
    {
        $range->getValues()->willReturn([0,1,2]);
        $this->create(1, 5);
        $this->intersect($range)->shouldBe([1, 2]);
    }

}
