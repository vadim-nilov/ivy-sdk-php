<?php

namespace Ivy\Service\Checkout;

use Ivy\Exceptions\ClientResponseException;
use Ivy\Resources\Checkout\Session as SessionResource;
use Ivy\Service\Service;

final class Session extends Service
{
    /**
     * @see: https://docs.getivy.de/reference#/checkout/session/create
     */
    public function create(SessionResource $sessionResource): SessionResource
    {
        return SessionResource::make(
            $this->request('/service/checkout/session/create', $sessionResource->toArray())
        );
    }

    /**
     * @see: https://docs.getivy.de/reference#/checkout/session/details
     * @throws ClientResponseException
     */
    public function retrieve(string $sessionId): SessionResource
    {
        return SessionResource::make(
            $this->request('/service/checkout/session/details', [
                'id' => $sessionId,
            ])
        );
    }
}
