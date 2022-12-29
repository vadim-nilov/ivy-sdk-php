<?php

namespace Ivy\Service\Checkout;

use Ivy\Exceptions\ClientResponseException;
use Ivy\Resources\Checkout\SessionResource;
use Ivy\Service\Service;

class Session extends Service
{
    /**
     * @see: https://docs.getivy.de/reference#/checkout/session/create.ts
     */
    public function create(SessionResource $sessionResource): SessionResource
    {
        return SessionResource::make($this->request('service/checkout/session/create.ts', $sessionResource->all()));
    }

    /**
     * @see: https://docs.getivy.de/reference#/checkout/session/details.ts
     * @throws ClientResponseException
     */
    public function retrieve(string $sessionId): SessionResource
    {
        return SessionResource::make($this->request('service/checkout/session/details.ts', [
            'id' => $sessionId
        ]));
    }
}
