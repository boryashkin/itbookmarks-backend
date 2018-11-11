<?php
namespace app\actions\api\auth\jira;

use app\abstracts\BaseAction;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class State extends BaseAction
{
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        $server = $request->getServerParams();
        $remoteAddr = $server['REMOTE_ADDR'];
        $userAgent = $server['HTTP_USER_AGENT'];
        $state = md5($remoteAddr . $userAgent);
        /** @var ServerRequestInterface $request */
        $response->getBody()->write(json_encode(['state' => $state]));

        return $response;
    }
}
