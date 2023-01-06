<?php

namespace Ivy\Dictionaries;

enum RefundStatus
{
    case PENDING;
    case SUCCEEDED;
    case FAILED;
    case REQUIRES_ACTION;
    case PARTIALLY_REFUNDED;
}