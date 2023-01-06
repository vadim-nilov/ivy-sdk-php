<?php

namespace Ivy\Dictionaries;

enum OrderStatus
{
    case FAILED;
    case CANCELED;
    case PROCESSING;
    case IN_HANDSHAKE;
    case WAITING_FOR_PAYMENT;
    case PAID;
    case IN_REFUND;
    case REFUNDED;
    case REFUND_FAILED;
    case PARTIALLY_REFUNDED;
    case IN_DISPUTE;
    case DISPUTED;
    case REFUSED;
}
