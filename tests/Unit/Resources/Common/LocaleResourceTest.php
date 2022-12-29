<?php

use PHPUnit\Framework\Assert;

it('returns the locale resource', function () {
    $data = [
        'locale' => 'de',
    ];

    Assert::assertInstanceOf(Ivy\Resources\Common\LocaleResource::class, Ivy\Resources\Checkout\SessionResource::make
    ($data)->locale);
});

it('returns the proper locale value', function () {
    $locale = \Ivy\Resources\Common\LocaleResource::make(['locale' => 'de']);

    Assert::assertEquals(\Ivy\Dictionaries\Locale::de, $locale->getLocale());
});