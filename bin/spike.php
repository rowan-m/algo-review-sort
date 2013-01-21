<?php
require __DIR__ . '/../vendor/autoload.php';

$total = 6;
$elements = array();

for ($index = 0; $index < $total; $index++) {
    $elements[$index] = mt_rand(0, 360);
}

//$elements = range(0, 300, 60);
//shuffle($elements);

$snaphots = new Sorting\IterationSnapshots();
$algorithm = new Sorting\QuickSort($elements);
//$algorithm = new Sorting\InsertionSort($elements);
$algorithm->addObserver($snaphots);
$algorithm->sort();