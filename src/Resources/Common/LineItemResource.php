<?php

namespace Ivy\Resources\Common;

use Decimal\Decimal;
use Ivy\Resources\ApiResource;

/**
 * @property-read string $name REQUIRED Customer-facing name of the line item.
 * @property-read string $referenceId An internal unique id stored to this line item.
 * @property-read int $singleNet REQUIRED
 * @property-read int $singleVat REQUIRED
 * @property-read Decimal $amount REQUIRED Accumulated cost in decimals. For example, for a lineItem with total price
 * 3.00 and quantity 4, amount would be equal to 12.00.
 * @property-read int $quantity Quantity of this lineItem.
 * @property-read string $image
 * @property-read string $category
 * @property-read string $EAN
 * @property-read int $co2Grams
 */
final class LineItemResource extends ApiResource
{
}
