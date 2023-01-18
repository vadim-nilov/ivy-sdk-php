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
        ->and($client->refund)->toBeInstanceOf(\Ivy\Service\Refund\Refund::class)
        ->and($client->order)->toBeInstanceOf(\Ivy\Service\Order\Order::class);
});

test('that api key provided to HttpClient', function () {
    $client = new \Ivy\Client('test');
    $httpClient = $client->getHttp();

    $reflectionObject = new ReflectionObject($httpClient);
    $reflectionProperty = $reflectionObject->getProperty('apiKey');

    expect($reflectionProperty->getValue($httpClient))->toEqual('test');
});

it('changes api key provided to HttpClient', function () {
    $client = new \Ivy\Client('test');
    $client->setApiKey('new key');
    $httpClient = $client->getHttp();

    $reflectionObject = new ReflectionObject($httpClient);
    $reflectionProperty = $reflectionObject->getProperty('apiKey');

    expect($reflectionProperty->getValue($httpClient))->toEqual('new key');
});

it('set HttpClient timeouts', function () {
    $client = new \Ivy\Client('test');
    $httpClient = $client->getHttp();
    $httpClient->setConnectTimeout(5);
    $httpClient->setTimeout(6);

    $reflectionObject = new ReflectionObject($httpClient);
    $connectTimeoutProperty = $reflectionObject->getProperty('connectTimeout');
    $timeoutProperty = $reflectionObject->getProperty('timeout');

    expect($connectTimeoutProperty->getValue($httpClient))->toEqual(5)
        ->and($timeoutProperty->getValue($httpClient))->toEqual(6);
});