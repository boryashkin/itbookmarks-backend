<?php
namespace app\actions\api\auth\jira;

use app\abstracts\BaseAction;
use app\modules\api\jira\JiraAuthorizator;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class Resources extends BaseAction
{
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        if (!$request->hasHeader('authorization')) {
            return $response->withStatus(403);
        }
        $bearerToken = (string)$request->getHeader('authorization')[0];
        $auth = new JiraAuthorizator();
        $response->getBody()->write($auth->exploreResources($bearerToken));

        return $response;
    }
}
