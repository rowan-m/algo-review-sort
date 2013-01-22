<?php

$app = new Silex\Application();

$app['debug'] = true;

$app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => __DIR__ . '/views',
));

$app['elements.total'] = 6;
$app['elements.min'] = 0;
$app['elements.max'] = 360;

$app['elements.random'] = function ($app) {
    $elements = array();

    for ($index = 0; $index < $app['elements.total']; $index++) {
        $elements[$index] = mt_rand($app['elements.min'], $app['elements.max']);
    }

    return $elements;
};

$app['sort.insertion'] = function () {
    return new Sorting\InsertionSort();
};

$app['sort.bubble'] = function () {
    return new Sorting\BubbleSort();
};

$app['sort.quick'] = function () {
    return new Sorting\QuickSort();
};

$app['sort.heap'] = function () {
    return new Sorting\HeapSort();
};

$app['observer.snapshots'] = function() {
    return new Sorting\IterationSnapshots();
};

$sortProvider = function($name) use ($app) {
    $name = 'sort.' . strtolower($app->escape($name));

    if (!isset($app[$name])) {
        $app->abort(404, 'No search algorithm found.');
    }

    return $app[$name];
};

$app->get('/sort/{algorithm}', function (Sorting\Algorithm $algorithm) use ($app) {
    if ($app['request']->get('total') && $app['request']->get('total') > 0) {
        $app['elements.total'] = (int) $app['request']->get('total');
    }

    $snapshots = $app['observer.snapshots'];
    $algorithm->addObserver($snapshots);
    $algorithm->sort($app['elements.random']);

    return $app['twig']->render('horizontal.html.twig', array(
        'snapshots' => $snapshots,
    ));
})->convert('algorithm', $sortProvider);

return $app;