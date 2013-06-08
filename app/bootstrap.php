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

$app['observer.sort.snapshots'] = function() {
    return new Sorting\IterationSnapshots();
};

$app['observer.search.snapshots'] = function() {
    return new Searching\IterationSnapshots();
};

$algorithmProvider = function($name, $type) use ($app) {
    $className = '\\' . $type . 'ing\\' . ucfirst(strtolower($app->escape($name))) . $type;
    if (!class_exists($className, true) || !is_subclass_of($className, '\\' . $type . 'ing\\Algorithm')) {
        $app->abort(404, 'No ' . strtolower($type) . ' algorithm found.');
    }

    return new $className();
};

$sortProvider = function($name) use ($algorithmProvider) {
    return $algorithmProvider($name, 'Sort');
};

$searchProvider = function($name) use ($algorithmProvider) {
    return $algorithmProvider($name, 'Search');
};

return $app;
