<?php

namespace Ivy\Resources\Checkout;

use Ivy\Resources\ApiResource;
use Ivy\Resources\Common\LineItem;
use Ivy\Resources\Common\Locale;
use Ivy\Resources\Common\Price;

/**
 * @property bool $express
 * @property bool $handshake If true, the order must be confirmed through the merchant. Always true for express sessions
 * @property string $plugin The plugin shop version
 * @property-read string $id The checkout session id. Response REQUIRED
 * @property-read string $appId Response REQUIRED
 * @property-read string $redirectUrl The shopper should be redirected here to complete the checkout
 * @property string $referenceId
 * @property string $displayId
 * @property string $offsetProject
 * @property mixed $metadata Any data which will be stored and returned for this checkout session and corresponding order
 * @property string $category The merchant category code of the shop
 * @property-read int $co2Grams
 * @property bool $guest Guest mode. If set to true, customers do not have to enter an email or signup with Ivy to complete an order. For express checkoutSessions this is always false.
 * @property Prefill $prefill
 * @property Price $price
 * @property array<LineItem> $lineItems
 * @property array $billingAddress
 * @property string $verificationToken
 * @property int $created
 * @property int $expiresAt
 * @property Locale $locale
 * @property-read string $createdAt
 * @property-read string $updatedAt
 * @property-read string $merchantAppId
 * @property-read string $abortReason
 * @property-read string $climateActionMode
 * @property Required $required
 */
final class Session extends ApiResource
{
    public static function make(array $data): static
    {
        $resource = parent::make($data);

        if (!empty(($data['prefill']))) {
            $resource->prefill = Prefill::make($data['prefill']);
        }

        if (!empty($data['price'])) {
            $resource->price = Price::make($data['price']);
        }

        if (!empty($data['locale'])) {
            $resource->locale = Locale::make([$data['locale']]);
        }

        if (!empty($data['required'])) {
            $resource->required = Required::make($data['required']);
        }

        if (!empty($data['lineItems'])) {
            $resource->lineItems = array_map(
                fn (array $lineItem) => LineItem::make($lineItem),
                $data['lineItems']
            );
        }

        return $resource;
    }
}
