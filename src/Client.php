<?php

namespace Ivy;

use Ivy\Exceptions\UndefinedServiceException;
use Ivy\Service\Banks\Banks;
use Ivy\Service\Checkout\Session;
use Ivy\Service\Merchant\Merchant;
use Ivy\Service\Order\Order;
use Ivy\Service\Refund\Refund;
use Ivy\Service\Service;
use Ivy\Service\ServiceFactory;

/**
 * @property-read Banks $banks
 * @property-read Session $session
 * @property-read Merchant $merchant
 * @property-read Refund $refund
 * @property-read Order $order
 */
final class Client
{
    private ?ServiceFactory $factory = null;

    private HttpClient $http;

    public function __construct(?string $apiKey = null)
    {
        $this->http = HttpClient::make();

        if (null !== $apiKey) {
            $this->http->setApiKey($apiKey);
        }
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

    public function setApiKey(string $apiKey): void
    {
        $this->http->setApiKey($apiKey);
    }

    public function getHttp(): HttpClient
    {
        return $this->http;
    }
}
