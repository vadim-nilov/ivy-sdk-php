<?php

namespace Ivy\Service;

use Ivy\Client;
use Ivy\Dictionaries\Services;
use Ivy\Exceptions\UndefinedServiceException;
use ValueError;

class ServiceFactory
{
    private array $services = [];

    public function __construct(private readonly Client $client)
    {
    }

    /**
     * @param string $className
     *
     * @return Service
     * @throws UndefinedServiceException
     */
    public function create(string $className): Service
    {
        try {
            $serviceClass = Services::from($className);
        } catch (ValueError $error) {
            throw new UndefinedServiceException($error->getMessage(), $error->getCode());
        }

        if (!isset($this->services[$className])) {
            $this->services[$className] = new $serviceClass($this->client);
        }

        return $this->services[$className];
    }
}