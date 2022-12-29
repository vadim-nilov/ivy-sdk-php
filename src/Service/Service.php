<?php

namespace Ivy\Service;

use Ivy\Client;
use Ivy\Exceptions\ClientResponseException;

class Service
{
    protected function __construct(private readonly Client $client)
    {
    }

    /**
     * @param string $path
     * @param array $parameters
     *
     * @return array
     * @throws ClientResponseException
     */
    protected function request(string $path, array $parameters): array
    {
        return $this->client->getHttp()->send($path, $parameters);
    }
}
