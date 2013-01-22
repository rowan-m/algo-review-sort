<?php

namespace Sorting;

class IterationSnapshots implements Observer, \IteratorAggregate
{
    private $iterations = array();

    public function notify(array $elements, array $indices)
    {
        $diff = array();

        if ($previous = end($this->iterations)) {
            $diff = array_diff_assoc($previous['elements'], $elements);
        }

        $this->iterations[] = array(
            'elements' => $elements,
            'diff' => $diff,
            'indices' => $indices,
        );
    }

    public function getIterator()
    {
        return new \ArrayIterator($this->iterations);
    }
}