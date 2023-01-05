<?php

namespace Ivy\Resources\Checkout;

use Ivy\Resources\ApiResource;
use Ivy\Resources\Banks\SearchResource;
use Ivy\Resources\Common\LineItemResource;
use Ivy\Resources\Common\LocaleResource;
use Ivy\Resources\Common\PriceResource;

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
 * @property PrefillResource $prefill
 * @property PriceResource $price
 * @property array<LineItemResource> $lineItems
 * @property array $billingAddress
 * @property string $verificationToken
 * @property int $created
 * @property int $expiresAt
 * @property LocaleResource $locale
 * @property-read string $createdAt
 * @property-read string $updatedAt
 * @property-read string $merchantAppId
 * @property-read string $abortReason
 * @property-read string $climateActionMode
 * @property RequiredResource $required
 */
final class SessionResource extends ApiResource
{
    public static function make(array $data): SessionResource
    {
        /** @var self $resource */
        $resource = parent::make($data);

        if (!empty(($data['prefill']))) {
            $resource->prefill = PrefillResource::make($data['prefill']);
        }

        if (!empty($data['price'])) {
            $resource->price = PriceResource::make($data['price']);
        }

        if (!empty($data['locale'])) {
            $resource->locale = LocaleResource::make([$data['locale']]);
        }

        if (!empty($data['required'])) {
            $resource->required = RequiredResource::make($data['required']);
        }

        if (!empty($data['lineItems'])) {
            $resource->lineItems = array_map(
                fn (array $lineItem) => LineItemResource::make($lineItem),
                $data['lineItems']
            );
        }

        return $resource;
    }
}
