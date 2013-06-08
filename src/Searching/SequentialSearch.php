<?php

namespace Searching;

class SequentialSearch implements Algorithm
{
    use ObservableTrait;

    public function search($target, array $elements)
    {
        $iterations = count($elements);

        for($index = 0; $index <= $iterations; $index++) {

            $this->notifyObservers(array($index));

            if ($target == $elements[$index]) {
                $this->notifyObservers(array($index));
                return true;
            }
        }

        return false;
    }
}
