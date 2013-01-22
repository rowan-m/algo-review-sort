<?php

namespace Sorting;

interface Observable
{
    public function addObserver(Observer $observer);

    public function notifyObservers(array $elements, array $indices);
}