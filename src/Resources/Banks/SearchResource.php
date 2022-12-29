<?php

namespace Ivy\Resources\Banks;

use Ivy\Resources\ApiResource;

/**
 * @property array<BankResource> $banks
 */
final class SearchResource extends ApiResource
{
    public static function make(array $data): static
    {
        $resource = parent::make($data);
        $resource->banks = array_map(fn (array $bank) => BankResource::make($bank), $resource->banks);

        return $resource;
    }
}
