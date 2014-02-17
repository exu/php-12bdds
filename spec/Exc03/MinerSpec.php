<?php

namespace spec\Exc03;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

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
