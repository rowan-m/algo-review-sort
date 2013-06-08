<?php

namespace Searching;

class BinarySearch implements Algorithm
{
    use ObservableTrait;

    public function search($target, array $elements)
    {
        return $this->doBinarySearch($target, $elements, 0, count($elements));
    }

    public function doBinarySearch($target, array $elements, $minIndex, $maxIndex)
    {
        if ($maxIndex < $minIndex) {
            return false;
        }

        $midIndex = floor(($minIndex + $maxIndex) / 2);
        $this->notifyObservers(array($midIndex));

        if ($elements[$midIndex] > $target) {
            return $this->doBinarySearch($target, $elements, $minIndex, $midIndex - 1);
        }

        if ($elements[$midIndex] < $target) {
            return $this->doBinarySearch($target, $elements, $midIndex + 1, $maxIndex);
        }

        $this->notifyObservers(array($midIndex));
        return true;
    }
}
