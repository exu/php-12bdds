<?php

namespace Exc04;

class Zonk
{
    protected $gates = [0,0,0];

    public function answer($number)
    {
        if (isset($this->gates[$number])) {
            $this->choice = $number;
            return true;
        }

        return false;
    }

    public function initGates()
    {
        $this->gates = [0,0,0];
        $this->gates[rand(0,2)] = 1;
    }

    public function getGates()
    {
        return $this->gates;
    }

}
