<?php

use PHPUnit\Framework\Assert;

it('returns resource instance', function () {
    $resource = \Ivy\Resources\ApiResource::make([]);

    expect($resource)->toBeInstanceOf(\Ivy\Resources\ApiResource::class);
});

it('returns data value by key', function () {
    $resource = \Ivy\Resources\ApiResource::make([
        'test' => 'value'
    ]);

    expect($resource->test)->toBe('value');
});

it('returns all data as an array', function () {
    $resource = \Ivy\Resources\ApiResource::make([
        'param1' => 'value1',
        'param2' => 'value2',
        'param3' => \Ivy\Resources\Banks\SearchResource::make(['test' => 1]),
        'param4' => \Ivy\Dictionaries\Currency::EUR,
    ]);

    $data = $resource->toArray();

    Assert::assertCount(4, $data);
    Assert::assertEquals(['test' => 1], $data['param3']);
    Assert::assertEquals('EUR', $data['param4']);
});