<?php

namespace Ivy\Service\Banks;

use Ivy\Exceptions\ClientResponseException;
use Ivy\Resources\Banks\SearchResource;
use Ivy\Service\Service;

class Banks extends Service
{
    /**
     * @param string $search
     *
     * @return SearchResource
     * @throws ClientResponseException
     */
    public function search(string $search): SearchResource
    {
        return SearchResource::make($this->request('/service/banks/search.ts', [
            'search' => $search
        ]));
    }
}
