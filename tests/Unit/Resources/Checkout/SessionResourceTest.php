<?php

use PHPUnit\Framework\Assert;

it('returns the session resource', function () {
    $data = [
        'referenceId' => 'test',
    ];

    Assert::assertInstanceOf(Ivy\Resources\Checkout\SessionResource::class, Ivy\Resources\Checkout\SessionResource::make($data));
});

it('returns the session resource with line item data', function () {
    $data = [
        'referenceId' => 'test',
        'lineItems' => [
            [
                'name' => 'test',
                'singleNet' => 1,
                'singleVat' => 2,
                'amount' => 3
            ]
        ]
    ];

    $resource = Ivy\Resources\Checkout\SessionResource::make($data);
    $lineItem = $resource->lineItems[0] ?? null;

    Assert::assertIsArray($resource->lineItems);
    Assert::assertCount(1, $resource->lineItems);
    Assert::assertInstanceOf(Ivy\Resources\Common\LineItemResource::class, $lineItem);
    /** @var \Ivy\Resources\Common\LineItemResource $lineItem */
    Assert::assertEquals('test', $lineItem->name);
    Assert::assertEquals(3, $lineItem->amount);
});