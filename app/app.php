<?php

$app = new Silex\Application();

$app['debug'] = true;

$app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => __DIR__ . '/views',
));

$app->get('/sort/{algorithm}', function ($algorithm) use ($app) {
    $total = 6;
    $elements = array();

    for ($index = 0; $index < $total; $index++) {
        $elements[$index] = mt_rand(0, 360);
    }

    $snapshots = new Sorting\IterationSnapshots();
    $algorithm = new Sorting\QuickSort($elements);
    $algorithm->addObserver($snapshots);
    $algorithm->sort();

    return $app['twig']->render('horizontal.html.twig', array(
        'snapshots' => $snapshots,
    ));
});

return $app;