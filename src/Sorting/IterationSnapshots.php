<?php

namespace Sorting;

class IterationSnapshots implements Observer, \IteratorAggregate
{
    private $iterations = array();

    private $indices = array();

    public function notify(Observable $sort)
    {
        $this->iterations[] = array(
            'elements' => $sort->getElements(),
            'index' => $sort->getIndex(),
        );
    }

    public function getIterator()
    {
        return new \ArrayIterator($this->iterations);
    }
}