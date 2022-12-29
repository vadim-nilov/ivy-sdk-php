<?php

namespace Ivy\Dictionaries;

use Ivy\Service\Banks\Banks;
use Ivy\Service\Checkout\Session;
use Ivy\Service\Merchant\Merchant;
use Ivy\Service\Merchant\Refund;
use Ivy\Service\Order\Order;

enum Services: string
{
    case BANKS = 'banks';
    case SESSION = 'session';
    case MERCHANT = 'merchant';
    case REFUND = 'refund';
    case ORDER = 'order';

    public function getClass(): string
    {
        return match ($this) {
            self::BANKS => Banks::class,
            self::SESSION => Session::class,
            self::MERCHANT => Merchant::class,
            self::REFUND => Refund::class,
            self::ORDER => Order::class,
        };
    }
}
