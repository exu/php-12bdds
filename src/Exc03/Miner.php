<?php

namespace Exc03;

class Miner
{
    public function getBombs($input)
    {
        $data = [];
        $input = str_replace(['*', '.'], ['1', '0'], $input);
        foreach((array) explode("\n", $input) as $i => $row) {
            if ($i == 0) {
                $dimensions = $row;
                continue;
            }
            $data[] = str_split($row);
        }

        return $data;
    }

    public function countNeighbourBombers($bombs, $i, $j)
    {
        $count = 0;

        $directions = [
            [0,-1],
            [0,1],
            [1,0],
            [1,1],
            [1,-1],
            [-1,-1],
            [-1,0],
            [-1,1],
        ];

        foreach ($directions as $direction) {
            $x = $i - $direction[0];
            $y = $j - $direction[1];

            if (isset($bombs[$x][$y])) {
                $count += $bombs[$x][$y];
            }
        }

        return $count;
    }

    public function getHint($input)
    {
        $bombs = $this->getBombs($input);

        for ($i = 0; $i < count($bombs); $i++) {
            for ($j = 0; $j < count($bombs[$i]); $j++) {
                if ($bombs[$i][$j]) {
                    $result[$i][$j] = '*';
                } else {
                    $result[$i][$j] = $this->countNeighbourBombers($bombs, $i, $j);
                }
            }
        }

        return $result;
    }

    public function parse($input)
    {
        $hints = $this->getHint($input);
        foreach ($hints as $row) {
            $data[] = implode("", $row);
        }

        return implode("\n", $data);
    }
}
