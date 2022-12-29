<?php

namespace Ivy\Resources\Checkout;

use Ivy\Resources\ApiResource;

/**
 * @property string $email
 * @property string $phone
 * @property string $bankId Retrieve a valid bankId with the POST /banks/search endpoint. When presented in this field, the customer will skip the bank selection in the Ivy Checkout.
 *
 */
final class PrefillResource extends ApiResource
{
}