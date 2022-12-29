<?php

use PHPUnit\Framework\Assert;

it('returns the array of bank resources', function () {
    $data = [
        'banks' => [
            [
                'name' => 'bank1',
                'id' => 'id1',
                'logo' => 'http://url',
                'url' => 'http://url',
                'provider' => 'provider1',
            ],
        ],
    ];

    Assert::assertIsArray(Ivy\Resources\Banks\SearchResource::make($data)->banks);
    Assert::assertCount(1, Ivy\Resources\Banks\SearchResource::make($data)->banks);
    Assert::assertInstanceOf(
        \Ivy\Resources\Banks\BankResource::class,
        Ivy\Resources\Banks\SearchResource::make($data)->banks[0]
    );
    Assert::assertInstanceOf(
        \Ivy\Resources\Banks\SearchResource::class,
        Ivy\Resources\Banks\SearchResource::make($data)
    );
});