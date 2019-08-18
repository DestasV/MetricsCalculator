<?php

namespace Supermetrics\Service;

use Supermetrics\Client\Client;
use Supermetrics\Client\HttpMethod;
use Supermetrics\ValueObject\Post;
use Supermetrics\ValueObject\Token;
use Supermetrics\ValueObject\User;

class DataFetcher
{
    private const REGISTER_URI = '/assignment/register';
    private const POSTS_URI = '/assignment/posts';
    /**
     * @var Client
     */
    private $client;
    /**
     * @var User
     */
    private $user;

    /**
     * DataFetcher constructor.
     *
     * @param Client $client
     * @param User   $user
     */
    public function __construct(Client $client, User $user)
    {
        $this->client = $client;
        $this->user = $user;
    }

    /**
     * @return array
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Exception
     */
    public function fetchPosts(): array
    {
        if ($this->user->getToken() === null) {
            $this->updateToken();
        }

        $posts = [];

        for ($i = 1; $i <= 10; $i++) {
            $response = $this->client->request(self::POSTS_URI, HttpMethod::GET, [
                'query' => [
                    'sl_token' => $this->user->getToken()->getToken(),
                    'page' => $i,
                ]
            ])->getBody()->getContents();

            $response = json_decode($response, true);

            foreach ($response['data']['posts'] as $data) {
                $posts[] = new Post(
                    $data['id'],
                    $data['from_id'],
                    $data['from_name'],
                    $data['type'],
                    new \DateTime($data['created_time']),
                    $data['message']
                );
            }
        }

        return $posts;
    }

    /**
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    private function updateToken(): self
    {
        $response = $this->client->request(self::REGISTER_URI, HttpMethod::POST,
            [
                'form_params' => $this->user->getCredentials()
            ]
        );

        $response = json_decode($response->getBody()->getContents(), true);
        $this->user->setToken(new Token($response['data']['sl_token']));

        return $this;
    }
}