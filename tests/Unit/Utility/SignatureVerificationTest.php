<?php

use PHPUnit\Framework\Assert;

it ('returns hash based on the provided key', function () {
    $sign = \Ivy\Utility\SignatureVerification::sign(json_encode(['test' => 'data']), 'abracadabra');

   Assert::assertNotEmpty($sign);
});

it ('verifies previously created signature with the provided key', function () {
    $signature = 'ad31a604d699308c513d6eda2f5a9fe8192618710f6b3dc30082167cfd00d26a'; // real signature from the example
    $testData = '{"id":"63bd92e159947009181280e4","type":"merchant_app_updated","payload":{"climateActionMode":{"type":"transaction"},"buttonOnlyShopTrees":false,"offsetProject":"io10","webhookUrl":"https://grumpy-streets-hide-95-91-242-21.loca.lt/ivy/webhook/payments","errorCallbackUrl":"https://api.didit.ws/ivy/callback","successCallbackUrl":"https://api.didit.ws/ivy/callback","hasApiKey":true,"platformType":"other","websiteUrl":"https://paydidit.com","completeCallbackUrl":"https://api.didit.ws/ivy/callback","quoteCallbackUrl":"https://api.didit.ws/ivy/callback","updatedAt":"2023-01-10T16:31:29.484Z","createdAt":"2022-12-29T16:39:15.770Z","id":"63adc2b31742bcdeb92da71a"},"date":"2023-01-10T16:31:29.521Z"}';
    $key = '3453e26e-c261-4d3e-aaec-b60e49bd900b';

    Assert::assertTrue(\Ivy\Utility\SignatureVerification::verify($signature, $testData, $key));
});

it ('return false for the wrong signature', function () {
    $signature = 'test'; // real signature from the example
    $testData = '{"id":"63bd92e159947009181280e4","type":"merchant_app_updated","payload":{"climateActionMode":{"type":"transaction"},"buttonOnlyShopTrees":false,"offsetProject":"io10","webhookUrl":"https://grumpy-streets-hide-95-91-242-21.loca.lt/ivy/webhook/payments","errorCallbackUrl":"https://api.didit.ws/ivy/callback","successCallbackUrl":"https://api.didit.ws/ivy/callback","hasApiKey":true,"platformType":"other","websiteUrl":"https://paydidit.com","completeCallbackUrl":"https://api.didit.ws/ivy/callback","quoteCallbackUrl":"https://api.didit.ws/ivy/callback","updatedAt":"2023-01-10T16:31:29.484Z","createdAt":"2022-12-29T16:39:15.770Z","id":"63adc2b31742bcdeb92da71a"},"date":"2023-01-10T16:31:29.521Z"}';
    $key = '3453e26e-c261-4d3e-aaec-b60e49bd900b';

    Assert::assertFalse(\Ivy\Utility\SignatureVerification::verify($signature, $testData, $key));
});