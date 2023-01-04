<?php

it('creates client', function () {
    $client = new \Ivy\Client('test');

    expect($client)->toBeInstanceOf(\Ivy\Client::class);
});

it('creates the service instances', function () {
    $client = new \Ivy\Client('test');

    expect($client->session)->toBeInstanceOf(\Ivy\Service\Checkout\Session::class)
        ->and($client->banks)->toBeInstanceOf(\Ivy\Service\Banks\Banks::class)
        ->and($client->merchant)->toBeInstanceOf(\Ivy\Service\Merchant\Merchant::class)
        ->and($client->refund)->toBeInstanceOf(\Ivy\Service\Merchant\Refund::class)
        ->and($client->order)->toBeInstanceOf(\Ivy\Service\Order\Order::class);
});