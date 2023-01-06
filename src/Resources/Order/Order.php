<?php

namespace Ivy\Resources\Order;

use Ivy\Dictionaries\OrderStatus;
use Ivy\Resources\ApiResource;
use Ivy\Resources\Common\Address;
use Ivy\Resources\Common\LineItem;
use Ivy\Resources\Common\Price;

/**
 * @property string $id REQUIRED
 * @property-read string $appId REQUIRED
 * @property string $shopName REQUIRED
 * @property string $referenceId REQUIRED
 * @property string $displayId
 * @property-read string $offsetProject
 * @property-read array $metadata
 * @property-read string $category
 * @property-read int $co2Grams
 * @property-read float $applicationFeeAmount
 * @property Price $price
 * @property array<LineItem> $lineItems
 * @property Address $billingAddress
 * @property Address $shippingAddress
 * @property OrderStatus $status
 * @property array $refunds
 * @property-read float $refundAmount
 * @property-read string $createdAt
 * @property-read string $updatedAt
 * @property-read array $shopper
 */
final class Order extends ApiResource
{
    public static function make(array $data): static
    {
        $resource = parent::make($data);

        if (!empty(($data['price']))) {
            $resource->price = Price::make($data['price']);
        }

        if (!empty(($data['billingAddress']))) {
            $resource->billingAddress = Address::make($data['billingAddress']);
        }

        if (!empty(($data['shippingAddress']))) {
            $resource->shippingAddress = Address::make($data['shippingAddress']);
        }

        if (!empty($data['lineItems'])) {
            $resource->lineItems = array_map(
                fn (array $lineItem) => LineItem::make($lineItem),
                $data['lineItems']
            );
        }

        return $resource;
    }

    public function __get(string $name)
    {
        if ($name === 'status' && isset($this->data['status']) && is_string($this->data['status'])) {
            $status = strtoupper($this->data['status']);

            return constant("Ivy\Dictionaries\OrderStatus::$status");
        }

        return parent::__get($name);
    }
}
