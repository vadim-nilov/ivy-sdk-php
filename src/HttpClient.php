<?php

namespace Ivy;

use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\RequestOptions;
use Ivy\Exceptions\ClientResponseException;

class HttpClient
{
    const AUTH_HEADER = 'X-IVY-API-KEY';
    const API_BASE = 'https://api.getivy.de/api';
    const API_SANDBOX_BASE = 'https://api.sand.getivy.de/api';

    private GuzzleClient $client;

    private static ?HttpClient $instance;

    private bool $sandboxMode = false;

    private function __construct(string $apiKey)
    {
        $this->client = new GuzzleClient([
            RequestOptions::HEADERS => [
                self::AUTH_HEADER => $apiKey
            ],
            RequestOptions::TIMEOUT => 3,
            RequestOptions::CONNECT_TIMEOUT => 3,
        ]);
    }

    public function setSandbox(bool $sandboxMode = false): void
    {
        $this->sandboxMode = $sandboxMode;
    }

    public static function make(string $apiKey): HttpClient
    {
        if (!isset(self::$instance)) {
            self::$instance = new self($apiKey);
        }

        return self::$instance;
    }

    /**
     * @param string $uri
     * @param array $parameters
     * @param int $attempts
     *
     * @return array
     * @throws ClientResponseException
     */
    public function send(string $uri, array $parameters, int $attempts = 1): array
    {
        do {
            $uri = $this->sandboxMode
                ? self::API_SANDBOX_BASE . $uri
                : self::API_BASE . $uri
            ;

            try {
                $response = $this->client->request('POST', $uri, ['json' => $parameters]);
            } catch (GuzzleException $exception) {
                throw new ClientResponseException($exception->getMessage(), $exception->getCode());
            }

            if ($response->getStatusCode() < 400) {
                return json_decode($response->getBody(), true);
            }

            $attempts--;
        } while ($attempts > 0);

        throw new ClientResponseException($response->getBody(), $response->getStatusCode());
    }

    private function __clone()
    {
    }
}
