<?php
namespace app\actions\api\auth\jira;

use app\abstracts\BaseAction;
use app\modules\api\jira\JiraAuthorizator;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class Token extends BaseAction
{
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        $server = $request->getServerParams();
        $remoteAddr = $server['REMOTE_ADDR'];
        $userAgent = $server['HTTP_USER_AGENT'];
        if ($request->getParsedBody()['state'] !== md5($remoteAddr . $userAgent)) {
            return $response->withStatus(403);
        }

        $auth = new JiraAuthorizator();
        $tokenCarrier = $auth->authorize($request->getParsedBody()['code']);
        $response->getBody()->write(json_encode(['token' => $tokenCarrier->getToken()]));

        return $response;
    }
}
