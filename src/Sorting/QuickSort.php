<?php

namespace Sorting;

class QuickSort implements Algorithm, Observable
{
    use ObservableTrait;

    public function sort(array $elements)
    {
        $this->notifyObservers($elements, array());
        $this->doQuickSort($elements, 0, count($elements) - 1);
    }

    function doQuickSort($elements, $leftIndex, $rightIndex)
    {
        $pivotIndex = ceil($leftIndex + (($rightIndex - $leftIndex) / 2));
        $pivotElement = $elements[$pivotIndex];
        $leftSwapIndex = $leftIndex;
        $rightSwapIndex = $rightIndex;
        $this->notifyObservers($elements, array($pivotIndex, $leftSwapIndex, $rightSwapIndex));

        while ($leftSwapIndex <= $rightSwapIndex) {
            while ($elements[$leftSwapIndex] < $pivotElement) {
                $leftSwapIndex++;
            }

            while ($elements[$rightSwapIndex] > $pivotElement) {
                $rightSwapIndex--;
            }

            if ($leftSwapIndex <= $rightSwapIndex) {
                $this->notifyObservers($elements, array($pivotIndex, $leftSwapIndex, $rightSwapIndex));
                $tmp = $elements[$leftSwapIndex];
                $elements[$leftSwapIndex] = $elements[$rightSwapIndex];
                $elements[$rightSwapIndex] = $tmp;
                $this->notifyObservers($elements, array($pivotIndex, $leftSwapIndex, $rightSwapIndex));
                $leftSwapIndex++;
                $rightSwapIndex--;
            }
        }

        if ($leftIndex < $rightSwapIndex) {
            $this->doQuickSort($elements, $leftIndex, $rightSwapIndex);
        }

        if ($leftSwapIndex < $rightIndex) {
            $this->doQuickSort($elements, $leftSwapIndex, $rightIndex);
        }
    }
}