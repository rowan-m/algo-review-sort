<?php

namespace Sorting;

interface Observable
{
    public function addObserver(Observer $observer);

    public function notifyObservers();

    public function getElements();

    public function getIndex();
}