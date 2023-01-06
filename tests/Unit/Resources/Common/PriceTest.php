<?php

use Ivy\Dictionaries\Currency;
use PHPUnit\Framework\Assert;

it('set the correct currency value', function () {
    $data = [
        'currency' => Currency::EUR,
        'totalNet' => 1,
        'vat' => 0,
        'shipping' => 0,
        'total' => 1,
    ];

    $resource = Ivy\Resources\Common\Price::make($data);
    $result = $resource->toArray();

    Assert::assertEquals('EUR', $result['currency']);
});

it('returns the correct string currency value', function () {
    $data = [
        'currency' => Currency::EUR,
        'totalNet' => 1,
        'vat' => 0,
        'shipping' => 0,
        'total' => 1,
    ];

    $resource = Ivy\Resources\Common\Price::make($data);
    Assert::assertInstanceOf(Currency::class, $resource->currency);
    Assert::assertEquals(Currency::EUR, $resource->currency);
});
