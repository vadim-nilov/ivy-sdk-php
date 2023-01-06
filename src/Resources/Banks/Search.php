<?php

namespace Ivy\Resources\Banks;

use Ivy\Resources\ApiResource;

/**
 * @property array<Bank> $banks
 */
final class Search extends ApiResource
{
    public static function make(array $data): static
    {
        $resource = parent::make($data);

        if (!empty($data['banks'])) {
            $resource->banks = array_map(fn (array $bank) => Bank::make($bank), $data['banks']);
        }

        return $resource;
    }
}
