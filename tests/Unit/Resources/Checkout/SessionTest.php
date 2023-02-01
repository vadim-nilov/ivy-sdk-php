<?php

use PHPUnit\Framework\Assert;

it('returns the session resource', function () {
    $data = [
        'referenceId' => 'test',
    ];

    Assert::assertInstanceOf(Ivy\Resources\Checkout\Session::class, Ivy\Resources\Checkout\Session::make($data));
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
        ],
        'locale' => 'de'
    ];

    $resource = Ivy\Resources\Checkout\Session::make($data);
    $lineItem = $resource->lineItems[0];

    Assert::assertIsArray($resource->lineItems);
    Assert::assertCount(1, $resource->lineItems);
    Assert::assertInstanceOf(Ivy\Resources\Common\LineItem::class, $lineItem);
    Assert::assertEquals('test', $lineItem->name);
    Assert::assertEquals(3, $lineItem->amount);
    Assert::assertEquals(\Ivy\Dictionaries\Locale::DE, $resource->locale);
});