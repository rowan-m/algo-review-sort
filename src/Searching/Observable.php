<?php

namespace Searching;

interface Observable
{
    public function addObserver(Observer $observer);

    public function notifyObservers(array $indices);
}
