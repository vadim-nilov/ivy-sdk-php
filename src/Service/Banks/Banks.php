<?php

namespace Ivy\Service\Banks;

use Ivy\Exceptions\ClientResponseException;
use Ivy\Resources\Banks\Search;
use Ivy\Service\Service;

final class Banks extends Service
{
    /**
     * @param string $search
     *
     * @return Search
     * @throws ClientResponseException
     */
    public function search(string $search): Search
    {
        return Search::make($this->request('/service/banks/search.ts', [
            'search' => $search
        ]));
    }
}
