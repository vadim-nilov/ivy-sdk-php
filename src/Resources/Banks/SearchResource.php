<?php

namespace Ivy\Resources\Banks;

use Ivy\Resources\ApiResource;

/**
 * @property array<BankResource> $banks
 */
final class SearchResource extends ApiResource
{
    public static function make(array $data): SearchResource
    {
        /** @var self $resource */
        $resource = parent::make($data);

        if (isset($data['banks'])) {
            $resource->banks = array_map(fn (array $bank) => BankResource::make($bank), $data['banks']);
        }

        return $resource;
    }
}
