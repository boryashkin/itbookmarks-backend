<?php
namespace app\actions\proxy\jira;

use app\abstracts\BaseAction;
use app\modules\proxy\jira\UrlBuilder;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Uri;
use MongoDB\Exception\BadMethodCallException;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class Main extends BaseAction
{
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        if (!$request->hasHeader('Authorization')) {
            return $response->withStatus(403);
        }
        $params = $request->getQueryParams();
        if (!isset($params['cloudId'])) {
            throw new BadMethodCallException('cloudId is required');
        }
        $route = $request->getAttribute('route');
        $api = $route->getArgument('path');
        $cloudId = $params['cloudId'];
        $url = UrlBuilder::getApiUrl($cloudId, $api);
        $client = new Client();
        $jiraRequest = clone $request;
        $jiraRequest = $jiraRequest->withUri(new Uri($url));
        $jiraResponse = $client->send($jiraRequest);
        $response->getBody()->write($jiraResponse->getBody()->getContents());

        return $response;
    }
}
