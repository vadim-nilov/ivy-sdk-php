<?php

namespace Ivy\Resources\Common;

use Ivy\Dictionaries\Currency;
use Ivy\Resources\ApiResource;

/**
 * @property-read int $totalNet
 * @property-read int $vat
 * @property-read int $shipping
 * @property-read int $total
 * @property-read Currency $currency
 */
final class PriceResource extends ApiResource
{
    public function __get(string $name)
    {
        if ($name === 'currency' && isset($this->data['currency']) && is_string($this->data['currency'])) {
            $currency = strtoupper($this->data['currency']);

            return constant("Ivy\Dictionaries\Currency::$currency");
        }

        return parent::__get($name);
    }
}
