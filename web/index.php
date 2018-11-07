<?php

require '../vendor/autoload.php';

$container = new \Slim\Container([]);
$app = new Slim\App($container);

$app->get('/api/index/index', \app\actions\api\index\Index::class);

$app->run();
