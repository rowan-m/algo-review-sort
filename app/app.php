<?php
$app = require_once __DIR__ . '/bootstrap.php';

$app->get('/sort/{algorithm}', function (Sorting\Algorithm $algorithm) use ($app) {
    if ($app['request']->get('total') && $app['request']->get('total') > 0) {
        $app['elements.total'] = (int) $app['request']->get('total');
    }

    $snapshots = $app['observer.snapshots'];
    $algorithm->addObserver($snapshots);
    $algorithm->sort($app['elements.random']);
    return $app['twig']->render('horizontal.html.twig', array(
        'snapshots' => $snapshots,
        'embedded' => (bool) $app['request']->get('embedded'),
    ));
})->convert('algorithm', $sortProvider);

$app->get('/presentation', function () use ($app) {
    return $app['twig']->render('presentation.html.twig');
});

return $app;