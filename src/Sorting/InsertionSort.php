<?php

namespace Sorting;

class InsertionSort implements Algorithm, Observable
{
    use ObservableTrait;

    public function sort(array $elements)
    {
        $iterations = count($elements);
        $this->notifyObservers($elements, array($insertIndex));

        for ($index = 1; $index < $iterations; $index++) {
            $elementToInsert = $elements[$index];
            $insertIndex = $index;
            $this->notifyObservers($elements, array($insertIndex));

            while ($insertIndex > 0 && $elementToInsert < $elements[$insertIndex - 1]) {
                $elements[$insertIndex] = $elements[$insertIndex - 1];
                $elements[$insertIndex - 1] = $elementToInsert;
                $insertIndex--;
                $this->notifyObservers($elements, array($insertIndex));
            }
        }

        $this->notifyObservers($elements, array($insertIndex));
    }
}