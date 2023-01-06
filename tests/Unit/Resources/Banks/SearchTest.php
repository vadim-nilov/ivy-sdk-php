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

    Assert::assertIsArray(Ivy\Resources\Banks\Search::make($data)->banks);
    Assert::assertCount(1, Ivy\Resources\Banks\Search::make($data)->banks);
    Assert::assertInstanceOf(
        \Ivy\Resources\Banks\Bank::class,
        Ivy\Resources\Banks\Search::make($data)->banks[0]
    );
    Assert::assertInstanceOf(
        \Ivy\Resources\Banks\Search::class,
        Ivy\Resources\Banks\Search::make($data)
    );
});