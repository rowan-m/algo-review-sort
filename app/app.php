<?php
$app = require_once __DIR__ . '/bootstrap.php';

$app->get('/sort/{algorithm}', function (Sorting\Algorithm $algorithm) use ($app) {
    if ($app['request']->get('total') && $app['request']->get('total') > 0) {
        $app['elements.total'] = (int) $app['request']->get('total');
    }

    $snapshots = $app['observer.sort.snapshots'];
    $algorithm->addObserver($snapshots);
    $algorithm->sort($app['elements.random']);
    return $app['twig']->render('sort-horizontal.html.twig', array(
        'snapshots' => $snapshots,
        'embedded' => (bool) $app['request']->get('embedded'),
    ));
})->convert('algorithm', $sortProvider);

$app->get('/search/{algorithm}', function (Searching\Algorithm $algorithm) use ($app) {
    if ($app['request']->get('total') && $app['request']->get('total') > 0) {
        $app['elements.total'] = (int) $app['request']->get('total');
    }

    $snapshots = $app['observer.search.snapshots'];
    $algorithm->addObserver($snapshots);
    $elements = $app['elements.random'];
    sort($elements);
    $target = $elements[array_rand($elements)];
    $algorithm->search($target, $elements);
    return $app['twig']->render('search-horizontal.html.twig', array(
        'elements' => $elements,
        'target' => $target,
        'snapshots' => $snapshots,
        'embedded' => (bool) $app['request']->get('embedded'),
    ));
})->convert('algorithm', $searchProvider);

$app->get('/example/stable', function () use ($app) {
    $snapshots = array(
        array('elements' => array('4:A', '1:A', '1:B', '3:A', '2:A', '3:B', '2:B', '2:C'), 'indices' => array()),
        array('elements' => array('1:A', '1:B', '2:A', '2:B', '2:C', '3:A', '3:B', '4:B'), 'indices' => array()),
    );

    return $app['twig']->render('sort-horizontal.html.twig', array(
        'snapshots' => $snapshots,
        'embedded' => (bool) $app['request']->get('embedded'),
    ));
});

$app->get('/example/unstable', function () use ($app) {
    $snapshots = array(
        array('elements' => array('4:A', '1:A', '1:B', '3:A', '2:A', '3:B', '2:B', '2:C'), 'indices' => array()),
        array('elements' => array('1:B', '1:A', '2:C', '2:B', '2:A', '3:A', '3:B', '4:B'), 'indices' => array()),
        array('elements' => array('1:A', '1:B', '2:A', '2:B', '2:C', '3:A', '3:B', '4:B'), 'indices' => array()),
    );

    return $app['twig']->render('sort-horizontal.html.twig', array(
        'snapshots' => $snapshots,
        'embedded' => (bool) $app['request']->get('embedded'),
    ));
});

$app->get('/', function () use ($app) {
    return $app['twig']->render('presentation.html.twig');
});

return $app;
