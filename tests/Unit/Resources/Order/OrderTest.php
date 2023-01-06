<?php

use Ivy\Dictionaries\Currency;
use PHPUnit\Framework\Assert;

it ('returns the order resource', function () {
    $data = [
        'id' => 'testId',
        'appId' => 'testAppId',
        'shopName' => 'testShopName',
        'referenceId' => 'testReferenceId',
        'displayId' => 'testDisplayId',
        'offsetProject' => 'testOffsetProject',
        'metadata' => [
            'orderId' => 'testOrderId',
            'merchantId' => 'testMerchantId',
        ],
        'category' => 1203,
        'co2Grams' => 123,
        'applicationFeeAmount' => '123',
        'price' => [
            'currency' => Currency::EUR,
            'totalNet' => 1,
            'vat' => 0,
            'shipping' => 0,
            'total' => 1,
        ],
        'lineItems' => [
            [
                'name' => 'test',
                'singleNet' => 1,
                'singleVat' => 2,
                'amount' => 3
            ]
        ],
        'billingAddress' => [
            'city' => 'Berlin',
        ],
        'shippingAddress' => [
            'line1' => 'Berlin street'
        ],
        'status' => 'failed',
        'refunds' => [
            [
                'id' => 'qwerty',
                'description' => 'some description',
                'referenceId' => 'testReferenceId',
                'amount' => 1.2,
                'status' => 'pending',
                'createdAt' => '2023-01-06 12:00:00',
                'updatedAt' => '2023-01-06 12:00:01',
            ]
        ],
        'refundAmount' => 1.2,
        'createdAt' => '2023-01-06 12:00:00',
        'updatedAt' => '2023-01-06 12:00:01',
        'shopper' => [
            'email' => 'test@gmail.com',
            'phone' => '017659991876'
        ],
    ];

    $resource = \Ivy\Resources\Order\Order::make($data);

    foreach ($data as $k => $val) {
        if ($k === 'price') {
            Assert::assertInstanceOf(\Ivy\Resources\Common\Price::class, $resource->{$k});
            continue;
        }

        if ($k === 'status') {
            Assert::assertInstanceOf(\Ivy\Dictionaries\OrderStatus::class, $resource->{$k});
            Assert::assertEquals(\Ivy\Dictionaries\OrderStatus::FAILED, $resource->{$k});
            continue;
        }

        if ($k === 'lineItems') {
            $items = $resource->{$k};
            foreach ($val as $i => $lineItem) {
                Assert::assertInstanceOf(\Ivy\Resources\Common\LineItem::class, $items[$i]);
            }
            continue;
        }

        if (in_array($k, ['billingAddress', 'shippingAddress'])) {
            Assert::assertInstanceOf(\Ivy\Resources\Common\Address::class, $resource->{$k});
        }

        if (is_scalar($val)) {
            Assert::assertEquals($val, $resource->{$k});
        }
    }
});