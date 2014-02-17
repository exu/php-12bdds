<?php

namespace spec\Exc04;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

/**
 *
 *  Monty Hall
 *
 *  Suppose you’re on a game show and you’re given the choice of three
 *  doors. Behind one door is a car; behind the others, goats. The car and the
 *  goats were placed randomly behind the doors before the show.
 *
 *  The rules of the game show are as follows:
 *
 *  After you have chosen a door, the door remains closed for the time being. The
 *  game show host, Monty Hall, who knows what is behind the doors, now has to
 *  open one of the two remaining doors, and the door he opens must have a goat
 *  behind it. If both remaining doors have goats behind them, he chooses one
 *  randomly. After Monty Hall opens a door with a goat, he will ask you to decide
 *  whether you want to stay with your first choice or to switch to the last
 *  remaining door.
 *
 *  For example: Imagine that you chose Door 1 and the host opens Door 3, which
 *  has a goat. He then asks you “Do you want to switch to Door Number 2?” Is it
 *  to your advantage to change your choice?
 *
 *  Note that the player may initially choose any of the three doors (not just
 *  Door 1), that the host opens a different door revealing a goat (not
 *  necessarily Door 3), and that he gives the player a second choice between the
 *  two remaining unopened doors.
 *
 *  Simulate at least a thousand games using three doors for each strategy and
 *  show the results in such a way as to make it easy to compare the effects of
 *  each strategy.
 */
class ZonkSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Exc04\Zonk');
    }

    function it_puts_car_and_goates_into_doors()
    {
        $this->reset();
        $this->getDoors()->shouldHaveCount(3);
    }


    function it_takes_user_first_choice()
    {
        $this->answer(1)->shouldBe(true);
        $this->answer(3)->shouldBe(false);
        $this->answer(0)->shouldBe(true);
    }


    function it_opens_doors()
    {
        $this->reset();
        $this->open(1);
        $this->getOpened()->shouldBe([1]);
        $this->open(0);
        $this->getOpened()->shouldBe([1,0]);
    }

    function it_records_gameplay()
    {
        $this->getRecords()->shouldHaveCount(0);
        $this->reset();
        $this->answer(0);
        $this->answer(1);
        $this->record()->shouldHaveCount(3);
        $this->getRecords()->shouldHaveCount(1);
    }


    function it_allow_to_play_with_doors()
    {
        for ($i = 0; $i < 1000; $i++) {
            $this->reset();
            $door = rand(0, 2);
            $this->answer($door);

            // change choosen door?
            $change = rand(0,1);
            if ($change) {
                do {
                    $changedDoor = rand(0, 2);
                } while($changedDoor == $door);

                $this->answer($changedDoor);
            }

            $this->record();
        }

        $this->getRecords()->shouldHaveCount(1000);

        $this->getGamesWithChange()->shouldBeBetween(0,1000);
        $this->getGamesWithoutChange()->shouldBeBetween(0,1000);
    }

    public function getMatchers()
    {
        return [
            'beBetween' => function($subject, $min, $max) {
                return is_int($subject) && $subject >= $min && $subject <= $max;
            }
        ];
    }
}
