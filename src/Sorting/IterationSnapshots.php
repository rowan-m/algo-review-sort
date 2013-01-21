<?php

namespace Sorting;

class IterationSnapshots implements Observer, \IteratorAggregate
{
    private $iterations = array();

    public function notify(Observable $sort)
    {
        $this->iterations[] = array(
            'elements' => $sort->getElements(),
            'indices' => $sort->getIndices(),
        );
    }

    public function getIterator()
    {
        return new \ArrayIterator($this->iterations);
    }
}