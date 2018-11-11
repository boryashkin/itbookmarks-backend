<?php
namespace app\actions\api\index;

use app\abstracts\BaseAction;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class Index extends BaseAction
{

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        $response->getBody()->write('{"Hello": "Guest"}');

        return $response;
    }
}
