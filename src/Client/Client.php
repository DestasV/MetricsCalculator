<?php

namespace Supermetrics\Client;

use GuzzleHttp\Client as GuzzleClient;

class Client
{
    /**
     * @var GuzzleClient
     */
    private $client;

    /**
     * Client constructor.
     *
     * @param string $baseUri
     */
    public function __construct(string $baseUri)
    {
        $config = [
            'base_uri' => $baseUri,
            'http_errors' => false,
            'verify' => false,
        ];

        $this->client = new GuzzleClient($config);
    }

    /**
     * @param string     $url
     * @param string     $method
     * @param array|null $params
     *
     * @return mixed|\Psr\Http\Message\ResponseInterface
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function request(string $url, string $method, array $params = null)
    {
        return $this->client->request($method, $url, $params);
    }
}