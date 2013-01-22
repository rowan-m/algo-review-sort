<?php

namespace Sorting;

trait ObservableTrait
{
    private $observers = array();

    public function addObserver(Observer $observer)
    {
        $this->observers[] = $observer;
    }

    public function notifyObservers(array $elements, array $indices)
    {
        foreach ($this->observers as $observer) {
            $observer->notify($elements, $indices);
        }
    }
}