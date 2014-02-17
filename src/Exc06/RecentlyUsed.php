<?php

namespace Exc06;

class RecentlyUsed extends \SplQueue
{
    protected $capacity = 0;

    public function enqueue($item = null)
    {
        if (empty($item)) {
            throw new \InvalidArgumentException('Empty values not allowed');
        }

        foreach($this as $i => $value) {
            if ($value == $item) {
                $this->offsetUnset($i);
            }
        }

        if ($this->capacity && $this->count() >= $this->capacity) {
            $this->shift();
        }

        parent::enqueue($item);
    }

    public function setCapacity($capacity)
    {
        $this->capacity = $capacity;
    }
}
