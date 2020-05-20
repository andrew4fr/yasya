<?php

namespace AK;

use GuzzleHttp\Client as Client;
use \Exception;

/**
 * Класс реализующий методы для работы с Github API
 */
class GitHubAPI {

    /**
     * @var string
     */
    protected $apiURL;

    /**
     * @var string
     */
    protected $token;

    public function __construct($url, $token)
    {
        $this->apiURL = $url;
        $this->token = $token;
    }

    /**
     * Метод получения персональной информации
     *
     * @throws \Exception
     * @return array
     */
    public function getPersonalInfo()
    {
        $client = $this->createClient();
        try {
            $response = $client->post('graphql',  ['body' => '{"query": "query {viewer { id login url } }"}']);
            $body = $response->getBody()->getContents();
            $data = json_decode($body, true);
        } catch(Exception $e) {
            return sprintf('Something gets wrong. Error - %s', $e->getMessage());
        }

        return $data;
    }

    public function getIssues($first)
    {
        return [];
    }

    protected function createClient()
    {
        return new Client([
            'base_uri' => $this->apiURL,
            'headers' => ['Authorization' => 'bearer ' . $this->token],
        ]);
    }
}
