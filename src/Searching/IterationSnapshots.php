<?php

namespace Searching;

class IterationSnapshots implements Observer, \IteratorAggregate
{
    private $iterations = array();

    public function notify(array $indices)
    {
        $previous = end($this->iterations);
        $attempts = array();

        if (!empty($previous)) {
            $attempts = array_merge($previous['indices'], $previous['attempts']);
        }

        $this->iterations[] = array(
            'indices' => $indices,
            'attempts' => $attempts,
        );
    }

    public function getIterator()
    {
        return new \ArrayIterator($this->iterations);
    }
}
