<?php

namespace Ivy;

use Ivy\Exceptions\UndefinedServiceException;
use Ivy\Service\Service;
use Ivy\Service\ServiceFactory;

class Client
{
    private ?ServiceFactory $factory;

    private HttpClient $http;

    public function __construct(private readonly string $apiKey)
    {
        $this->http = HttpClient::make($this->apiKey);
    }

    /**
     * @param string $serviceName
     *
     * @return Service
     * @throws UndefinedServiceException
     */
    public function __get(string $serviceName): Service
    {
        if (null === $this->factory) {
            $this->factory = new ServiceFactory($this);
        }

        return $this->factory->create($serviceName);
    }

    public function useSandbox(): void
    {
        $this->http->setSandbox(true);
    }

    public function getHttp(): HttpClient
    {
        return $this->http;
    }
}
