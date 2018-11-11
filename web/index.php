<?php
define('ENV_PROD', true);

require '../vendor/autoload.php';

$container = new \Slim\Container([
    'settings' => [
        'displayErrorDetails' => !ENV_PROD,
    ],
]);
$app = new Slim\App($container);

$app->get('/api/index/index', \app\actions\api\index\Index::class);
$app->get('/api/auth/jira/state', \app\actions\api\auth\jira\State::class);
$app->post('/api/auth/jira/token', \app\actions\api\auth\jira\Token::class);

$app->run();
