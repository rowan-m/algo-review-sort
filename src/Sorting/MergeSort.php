<?php

namespace Sorting;

class MergeSort implements Algorithm, Observable
{
    use ObservableTrait;

    public function sort(array $elements)
    {
        $this->notifyObservers($elements, array());
        $elements = $this->doMergeSort($elements, 0, count($elements) - 1);
        $this->notifyObservers($elements, array());
    }

    private function doMergeSort(array $elements, $leftIndex, $rightIndex)
    {
        $leftScanIndex = $leftIndex;
        $rightScanIndex = $rightIndex;

        if ($leftScanIndex >= $rightScanIndex) {
            return $elements;
        }

        $midIndex = floor(($leftScanIndex + $rightScanIndex) / 2);

        $this->notifyObservers($elements, array($midIndex, $leftIndex, $rightIndex));
        $elements = $this->doMergeSort($elements, $leftScanIndex, $midIndex);
        $elements = $this->doMergeSort($elements, $midIndex + 1, $rightScanIndex);

        $leftPartitionEnd = $midIndex;
        $rightPartionStart = $midIndex + 1;

        while (($leftScanIndex <= $leftPartitionEnd) && ($rightPartionStart <= $rightScanIndex)) {
            if ($elements[$leftScanIndex] < $elements[$rightPartionStart]) {
                $leftScanIndex++;
            } else {
                $tmp = $elements[$rightPartionStart];

                for ($scanIndex = $rightPartionStart - 1; $scanIndex >= $leftScanIndex; $scanIndex--) {
                    $swap = $elements[$scanIndex + 1];
                    $elements[$scanIndex + 1] = $elements[$scanIndex];
                    $elements[$scanIndex] = $swap;
                $this->notifyObservers($elements, array($leftScanIndex, $rightPartitionStart - 1));
                }

                $elements[$leftScanIndex] = $tmp;
                $this->notifyObservers($elements, array($leftScanIndex, $rightPartitionStart - 1));
                $leftScanIndex++;
                $leftPartitionEnd++;
                $rightPartionStart++;
            }
        }

        return $elements;
    }
}
