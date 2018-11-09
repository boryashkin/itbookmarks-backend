<?php
namespace app\actions\api\index;

use app\abstracts\BaseAction;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class Jira extends BaseAction
{
    public function __invoke(RequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        $response->getBody()->write('{"Hello": "Guest"}');

        return $response;
    }
}
