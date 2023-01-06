<?php

namespace Ivy\Resources\Merchant;

use Ivy\Resources\ApiResource;

/**
 * @property-read string $orderStatus
 * @property-read string $refundStatus
 * @property-read string $orderId
 * @property-read string $referenceId
 * @property-read string $error
 */
final class RefundResponse extends ApiResource
{
    public function __get(string $name)
    {
        if ($name === 'orderStatus' && isset($this->data['orderStatus']) && is_string($this->data['orderStatus'])) {
            $status = strtoupper($this->data['orderStatus']);

            return constant("Ivy\Dictionaries\OrderStatus::$status");
        }

        if ($name === 'refundStatus' && isset($this->data['refundStatus']) && is_string($this->data['refundStatus'])) {
            $status = strtoupper($this->data['refundStatus']);

            return constant("Ivy\Dictionaries\RefundStatus::$status");
        }

        return parent::__get($name);
    }
}
