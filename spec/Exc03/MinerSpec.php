<?php

namespace spec\Exc03;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;


/**
 *  A field of N x M squares is represented by N lines of exactly M characters each. The character ‘*’ represents a mine and the character ‘.’ represents no-mine.
 *
 *  Example input (a 3 x 4 mine-field of 12 squares, 2 of
 *  which are mines)
 *  3 4 *... ..*. ....
 *  Your task is to write a program to accept this input and produce as output a hint-field of identical dimensions where each square is a * for a mine or the number of adjacent mine-squares if the square does not contain a mine.
 *
 *  Example output (for the above input)
 *
 *  *211 12*1 0111
 */
class MinerSpec extends ObjectBehavior
{

    protected $data = [
         [
             "input" => "3 4\n*...\n..*.\n....",
             "dimensions" => [3, 4],
             "bombs" => [
                 [1,0,0,0],
                 [0,0,1,0],
                 [0,0,0,0],
             ],
             "hint" => [
                 ["*",2,1,1],
                 [1,2,"*",1],
                 [0,1,1,1],
             ],
             "output" => "*211\n12*1\n0111"
        ],
    ];

    function it_is_initializable()
    {
        $this->shouldHaveType('Exc03\Miner');
    }

    function its_intelligence_gives_us_bombs_position()
    {
        foreach ($this->data as $data) {
            $this->getBombs($data['input'])->shouldBeLike($data['bombs']);
        }
    }

    function it_returns_hints_data_array()
    {
        foreach ($this->data as $data) {
            $this->getHint($data['input'])->shouldBeLike($data['hint']);
        }
    }

    function it_counts_neighbour_suicide_bombers()
    {
        $this->countNeighbourBombers([[1,0,0], [1,0,0], [1,0,0]], 1, 1)->shouldBe(3);
        $this->countNeighbourBombers([[1,0,0], [1,0,0], [1,0,0]], 2, 2)->shouldBe(0);
        $this->countNeighbourBombers([[1,0,0], [1,0,0], [1,0,0]], 0, 0)->shouldBe(1);
    }

    function it_returns_string_output()
    {
        foreach ($this->data as $data) {
            $this->parse($data['input'])->shouldBeLike($data['output']);
        }
    }

}
