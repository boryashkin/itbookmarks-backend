<?php
namespace app\modules\api\jira;

class JiraAuthorizator
{
    /**
     * @param $authCode
     * @return \League\OAuth2\Client\Token\AccessToken
     */
    public function authorize(string $authCode)
    {
        $provider = new \League\OAuth2\Client\Provider\GenericProvider([
            'clientId'                => getenv('JIRA_CLIENT_ID'),
            'clientSecret'            => getenv('JIRA_SECRET'),
            'redirectUri'             => getenv('JIRA_REDIRECT'),
            'urlAuthorize'            => 'https://auth.atlassian.com/oauth/authorize',
            'urlAccessToken'          => 'https://auth.atlassian.com/oauth/token',
            'urlResourceOwnerDetails' => '/', //Не реализовано
            'scopes'                  => 'todo',
        ]);

        $jwtToken = $provider->getAccessToken('authorization_code', [
            'code' => $authCode,
            'redirect_uri' => getenv('JIRA_REDIRECT'),
        ]);
        $jwt = (new \Lcobucci\JWT\Parser())->parse($jwtToken->getToken());
        //$accountId = $jwt->getClaim('sub');
        //$scopes = $jwt->getClaim('scopes');
        if ($jwt->isExpired()) {
            //?
        }

        return $jwtToken;
    }
}
