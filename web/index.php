<?php
require_once __DIR__.'/../vendor/autoload.php';

$app = new Silex\Application();

$app->get('/sort/{algorithm}', function ($algorithm) use ($app) {
    return 'Sorting: '.$app->escape($algorithm);
});

$app->run();