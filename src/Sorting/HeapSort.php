<?php

namespace Sorting;

class HeapSort implements Algorithm, Observable
{

    use ObservableTrait;

    public function sort(array $elements)
    {
        $size = count($elements);
        $this->notifyObservers($elements, array());

        for ($index = floor(($size / 2)) - 1; $index >= 0; $index--) {
            $elements = $this->siftDown($elements, $index, $size);
        }

        for ($index = $size - 1; $index >= 1; $index--) {
            $this->notifyObservers($elements, array($index, 0));
            $tmp = $elements[0];
            $elements[0] = $elements[$index];
            $elements[$index] = $tmp;
            $this->notifyObservers($elements, array($index, 0));
            $elements = $this->siftDown($elements, 0, $index - 1);
        }

        return $elements;
    }

    public function siftDown(array $elements, $root, $bottom)
    {
        $done = false;

        while (($root * 2 <= $bottom) && (!$done)) {
            if ($root * 2 == $bottom) {
                $maxChild = $root * 2;
            } elseif ($elements[$root * 2] > $elements[$root * 2 + 1]) {
                $maxChild = $root * 2;
            } else {
                $maxChild = $root * 2 + 1;
            }

            if ($elements[$root] < $elements[$maxChild]) {
                $this->notifyObservers($elements, array($root, $maxChild));
                $tmp = $elements[$root];
                $elements[$root] = $elements[$maxChild];
                $elements[$maxChild] = $tmp;
                $this->notifyObservers($elements, array($root, $maxChild));
                $root = $maxChild;
            } else {
                $done = true;
            }
        }

        return $elements;
    }
}

