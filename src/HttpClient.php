<?php

namespace Ivy;

use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\RequestOptions;
use Ivy\Exceptions\ClientResponseException;

final class HttpClient
{
    const AUTH_HEADER = 'X-IVY-API-KEY';
    const API_BASE = 'https://api.getivy.de/api';
    const API_SANDBOX_BASE = 'https://api.sand.getivy.de/api';

    const REQUEST_INTERVAL_STEP = 100;

    private GuzzleClient $client;

    private static ?HttpClient $instance;

    private bool $sandboxMode = false;

    private string $apiKey = '';

    private int $timeout = 10;
    private int $connectTimeout = 3;

    private function __construct()
    {
        $this->client = new GuzzleClient([
            RequestOptions::TIMEOUT => $this->timeout,
            RequestOptions::CONNECT_TIMEOUT => $this->connectTimeout,
        ]);
    }

    public function setApiKey($apiKey): void
    {
        $this->apiKey = $apiKey;
    }

    public function setSandbox(bool $sandboxMode = false): void
    {
        $this->sandboxMode = $sandboxMode;
    }

    public function setTimeout(int $timeout): void
    {
        $this->timeout = $timeout;
    }

    public function setConnectTimeout(int $connectTimeout): void
    {
        $this->connectTimeout = $connectTimeout;
    }

    public static function make(): HttpClient
    {
        if (!isset(self::$instance)) {
            self::$instance = new self();
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
        $interval = 0;
        do {
            $uri = $this->sandboxMode
                ? self::API_SANDBOX_BASE . $uri
                : self::API_BASE . $uri
            ;

            try {
                $response = $this->client->request('POST', $uri, [
                    'json' => $parameters,
                    'headers' => [self::AUTH_HEADER => $this->apiKey]
                ]);
            } catch (GuzzleException $exception) {
                throw new ClientResponseException($exception->getMessage(), $exception->getCode());
            }

            if ($response->getStatusCode() < 400) {
                return json_decode($response->getBody(), true);
            }

            $attempts--;
            $interval += self::REQUEST_INTERVAL_STEP * 1000;
            usleep($interval);
        } while ($attempts > 0);

        throw new ClientResponseException($response->getBody(), $response->getStatusCode());
    }

    private function __clone()
    {
    }
}
