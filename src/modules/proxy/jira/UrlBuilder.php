<?php
namespace app\modules\proxy\jira;

class UrlBuilder
{
    private const JIRA_CLOUD_PATTERN = 'https://api.atlassian.com/ex/jira/{cloudid}/{api}';

    /**
     * Get url to api for cloudId
     *
     * @param string $cloudId
     * @param string $api
     * @return mixed
     */
    public static function getApiUrl(string $cloudId, string $api)
    {
        return str_replace(['{cloudid}', '{api}'], [$cloudId, $api], self::JIRA_CLOUD_PATTERN);
    }
}