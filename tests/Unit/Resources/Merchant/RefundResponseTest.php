<?php

use PHPUnit\Framework\Assert;

it('returns refund response instance', function () {
    $data = [
        'orderStatus' => 'failed',
        'refundStatus' => 'partially_refunded',
        'orderId' => 'test',
        'referenceId' => 'testReferenceId',
    ];

    $resource = \Ivy\Resources\Merchant\RefundResponse::make($data);

    Assert::assertInstanceOf(\Ivy\Resources\Merchant\RefundResponse::class, $resource);
    Assert::assertInstanceOf(\Ivy\Dictionaries\RefundStatus::class, $resource->refundStatus);
    Assert::assertInstanceOf(\Ivy\Dictionaries\OrderStatus::class, $resource->orderStatus);
    Assert::assertEquals(\Ivy\Dictionaries\RefundStatus::PARTIALLY_REFUNDED, $resource->refundStatus);
    Assert::assertEquals(\Ivy\Dictionaries\OrderStatus::FAILED, $resource->orderStatus);
});