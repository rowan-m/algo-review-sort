<?php

namespace Sorting;

class InsertionSort implements Algorithm, Observable
{

    use ObservableTrait;

    private $elements;

    private $positionToInsert;

    public function __construct()
    {
    }

    public function sort(array $elements)
    {
        $this->elements = $elements;
        $iterations = count($this->elements);
        $this->notifyObservers();

        for ($index = 1; $index < $iterations; $index++) {
            $elementToInsert = $this->elements[$index];
            $this->positionToInsert = $index;
            $this->notifyObservers();

            while ($this->positionToInsert > 0 && $elementToInsert < $this->elements[$this->positionToInsert - 1]) {
                $this->elements[$this->positionToInsert] = $this->elements[$this->positionToInsert - 1];
                $this->elements[$this->positionToInsert - 1] = $elementToInsert;
                $this->positionToInsert--;
                $this->notifyObservers();
            }
        }

        $this->notifyObservers();
    }

    public function getElements()
    {
        return $this->elements;
    }

    public function getIndices()
    {
        return array($this->positionToInsert);
    }
}