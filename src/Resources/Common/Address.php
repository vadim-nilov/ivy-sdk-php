<?php

namespace Ivy\Resources\Common;

use Ivy\Resources\ApiResource;

/**
 * @property string $firstName
 * @property string $lastName
 * @property string $line1 REQUIRED
 * @property string $line2
 * @property string $region
 * @property string $city REQUIRED
 * @property string $zipCode REQUIRED
 * @property string $country REQUIRED
 */
final class Address extends ApiResource
{
}
