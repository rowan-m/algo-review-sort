<?php

namespace Sorting;

class BubbleSort implements Algorithm, Observable
{

    use ObservableTrait;

    public function sort(array $elements)
    {
        $this->notifyObservers($elements, array());

        for ($index = count($elements); $index > 0; $index--) {
            $swapped = false;
            $this->notifyObservers($elements, array($index - 1));

            for ($swapIndex = 0; $swapIndex < $index - 1; $swapIndex++) {
                $this->notifyObservers($elements, array($index - 1, $swapIndex));

                if ($elements[$swapIndex] > $elements[$swapIndex + 1]) {
                    $tmp = $elements[$swapIndex];
                    $elements[$swapIndex] = $elements[$swapIndex + 1];
                    $elements[$swapIndex + 1] = $tmp;
                    $swapped = true;
                }
            }

            $this->notifyObservers($elements, array($index - 1, $swapIndex));

            if (!$swapped) {
                return $elements;
            }
        }
    }
}