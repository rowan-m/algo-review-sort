<?php

namespace Searching;

trait ObservableTrait
{
    private $observers = array();

    public function addObserver(Observer $observer)
    {
        $this->observers[] = $observer;
    }

    public function notifyObservers(array $indices)
    {
        foreach ($this->observers as $observer) {
            $observer->notify($indices);
        }
    }
}
