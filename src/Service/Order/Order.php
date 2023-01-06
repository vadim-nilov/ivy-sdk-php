<?php

namespace Ivy\Service\Order;

use Ivy\Exceptions\ClientResponseException;
use Ivy\Resources\Order\Order as OrderResource;
use Ivy\Service\Service;

class Order extends Service
{
    /**
     * @param string $id
     *
     * @return OrderResource
     * @throws ClientResponseException
     */
    public function retrieve(string $id): OrderResource
    {
        return OrderResource::make(
            $this->request('service/merchant/payment/refund.ts', ['id' => $id])
        );
    }

    /**
     * @param OrderResource $order
     *
     * @return OrderResource
     * @throws ClientResponseException
     */
    public function update(OrderResource $order): OrderResource
    {
        return OrderResource::make(
            $this->request('service/merchant/payment/refund.ts', $order->toArray())
        );
    }
}