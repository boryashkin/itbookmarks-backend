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
$app->map(['POST', 'GET'], '/proxy/jira/main/{path:.*}', \app\actions\proxy\jira\Main::class);
$app->get('/api/auth/jira/resources', \app\actions\api\auth\jira\Resources::class);

$app->run();
