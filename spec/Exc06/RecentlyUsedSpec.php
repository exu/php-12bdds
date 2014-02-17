<?php

namespace spec\Exc06;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

/**
 *  Develop a recently-used-list class to hold strings uniquely in Last-In-First-Out order.
 *
 *  A recently-used-list is initially empty.
 *  The most recently added item is first, the leastrecently added item is last.
 *  Items can be looked up by index, which counts from zero.
 *  Items in the list are unique, so duplicate insertions are moved rather than added.
 *  Optional extras:
 *  Null insertions (empty strings) are not allowed.
 *  A bounded capacity can be specified, so there is an upper limit to the number of items contained,
 *  with the least recently added items dropped on overflow.
 */
class RecentlyUsedSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Exc06\RecentlyUsed');
        $this->shouldBeAnInstanceOf('\SplQueue');
    }

    function it_enqueue_new_items()
    {
        $this->enqueue(1);
        $this->dequeue()->shouldBe(1);
    }

    function it_adds_first_things_first_last_things_last()
    {
        $this->enqueue(1);
        $this->enqueue(2);
        $this->enqueue(3);
        $this->dequeue()->shouldBe(1);
        $this->dequeue()->shouldBe(2);
        $this->dequeue()->shouldBe(3);
    }

    function it_search_items_by_index()
    {
        $this->enqueue(1);
        $this->enqueue(2);
        $this->enqueue(3);

        $this->offsetGet(2)->shouldBe(3);
        $this->offsetGet(1)->shouldBe(2);
        $this->offsetGet(0)->shouldBe(1);
    }

    function it_adds_only_unique_items()
    {
        $this->enqueue(1);
        $this->enqueue(2);
        $this->enqueue(3);

        $this->enqueue(3);
        $this->enqueue(2);
        $this->enqueue(1);

        $this->dequeue()->shouldBe(3);
        $this->dequeue()->shouldBe(2);
        $this->dequeue()->shouldBe(1);
    }

    function it_allow_only_not_null_values()
    {
        $this->shouldThrow('\InvalidArgumentException')->duringEnqueue();
    }

    function it_has_capacity()
    {
        $this->setCapacity(3);

        $this->enqueue(1);
        $this->enqueue(2);
        $this->enqueue(3);
        $this->enqueue(4);
        $this->enqueue(5);
        $this->enqueue(6);

        $this->count()->shouldBe(3);

        $this->dequeue()->shouldBe(4);
        $this->dequeue()->shouldBe(5);
        $this->dequeue()->shouldBe(6);
    }


}
