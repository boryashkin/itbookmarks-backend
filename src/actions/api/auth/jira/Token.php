<?php
namespace app\actions\api\auth\jira;

use app\abstracts\BaseAction;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class Token extends BaseAction
{
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        $response->getBody()->write(json_encode(['token' => md5(time())]));

        return $response;
    }
}
