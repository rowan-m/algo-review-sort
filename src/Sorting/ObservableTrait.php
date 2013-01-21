<?php

namespace Sorting;

trait ObservableTrait
{
    private $observers = array();

    public function addObserver(Observer $observer)
    {
        $this->observers[] = $observer;
    }

    public function notifyObservers()
    {
        foreach ($this->observers as $observer) {
            $observer->notify($this);
        }
    }
}