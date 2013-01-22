<?php

namespace Sorting;

class QuickSort implements Algorithm, Observable
{
    use ObservableTrait;

    private $elements;

    private $pivotIndex = -1;

    private $leftPartitionIndex = -1;

    private $rightPartitionIndex = -1;

    private $indices = array();

    public function __construct()
    {
    }

    public function sort(array $elements)
    {
        $this->elements = $elements;
        $this->quickSort(0, count($this->elements) - 1);
    }

    function quickSort($leftIndex, $rightIndex)
    {
        $this->pivotIndex = ceil($leftIndex + (($rightIndex - $leftIndex) / 2));
        $pivotElement = $this->elements[$this->pivotIndex];
        $this->leftPartitionIndex = $leftIndex;
        $this->rightPartitionIndex = $rightIndex;
        $this->notifyObservers();

        while ($this->leftPartitionIndex <= $this->rightPartitionIndex) {
            while ($this->elements[$this->leftPartitionIndex] < $pivotElement) {
                $this->leftPartitionIndex++;
            }

            while ($this->elements[$this->rightPartitionIndex] > $pivotElement) {
                $this->rightPartitionIndex--;
            }

            if ($this->leftPartitionIndex <= $this->rightPartitionIndex) {
                $this->notifyObservers();
                $tmp = $this->elements[$this->leftPartitionIndex];
                $this->elements[$this->leftPartitionIndex] = $this->elements[$this->rightPartitionIndex];
                $this->elements[$this->rightPartitionIndex] = $tmp;
                $this->notifyObservers();
                $this->leftPartitionIndex++;
                $this->rightPartitionIndex--;
            }
        }

        if ($leftIndex < $this->rightPartitionIndex) {
            $this->quickSort($leftIndex, $this->rightPartitionIndex);
        }

        if ($this->leftPartitionIndex < $rightIndex) {
            $this->quickSort($this->leftPartitionIndex, $rightIndex);
        }
    }

    public function getElements()
    {
        return $this->elements;
    }

    public function getIndices()
    {
        return array($this->pivotIndex, $this->leftPartitionIndex, $this->rightPartitionIndex);
    }
}