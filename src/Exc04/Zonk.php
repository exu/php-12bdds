<?php

namespace Exc04;

class Zonk
{
    protected $doors = [0,0,0];
    protected $opened = [];
    protected $choice = false;
    protected $choices = [];
    protected $records = [];

    public function answer($number)
    {
        if (isset($this->doors[$number])) {
            $this->choice = $number;
            array_push($this->choices, $number);

            return true;
        }

        return false;
    }

    public function reset()
    {
        $this->choices = [];
        $this->opened = [];
        $this->doors = [0,0,0];
        $this->doors[rand(0,2)] = 1;
    }

    public function getDoors()
    {
        return $this->doors;
    }


    public function open($door)
    {
        array_push($this->opened, $door);
    }

    public function getOpened()
    {
        return $this->opened;
    }

    public function record()
    {
        $record['choices'] = $this->choices;
        $record['opened'] = $this->opened;
        $record['doors'] = $this->doors;

        $this->records[] = $record;

        return $record;
    }

    public function getRecords()
    {
        return $this->records;
    }

    public function getGamesWithChange()
    {
        $count = 0;
        foreach($this->records as $record) {
            $count += (int) (count($record['choices']) === 1);
        }

        return $count;
    }

    public function getGamesWithoutChange()
    {
        $count = 0;
        foreach($this->records as $record) {
            $count += (int) (count($record['choices']) === 2);
        }

        return $count;
    }
}
