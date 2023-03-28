<?php

namespace Ivy\Service\Merchant;

use Ivy\Exceptions\ClientResponseException;
use Ivy\Resources\Merchant\Merchant as MerchantResource;
use Ivy\Service\Service;

final class Merchant extends Service
{
    /**
     * @param MerchantResource $merchant
     *
     * @return MerchantResource
     * @throws ClientResponseException
     */
    public function update(MerchantResource $merchant): MerchantResource
    {
        return MerchantResource::make(
            $this->request(
                'service/merchant/update',
                $merchant->toArray()
            )
        );
    }
}