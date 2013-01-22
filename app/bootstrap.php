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

$app['observer.snapshots'] = function() {
    return new Sorting\IterationSnapshots();
};

$sortProvider = function($name) use ($app) {
    $className = '\\Sorting\\'.ucfirst(strtolower($app->escape($name))).'Sort';

    if (!class_exists($className, true) || !is_subclass_of($className, '\\Sorting\\Algorithm')) {
        $app->abort(404, 'No search algorithm found.');
    }

    return new $className();
};

return $app;