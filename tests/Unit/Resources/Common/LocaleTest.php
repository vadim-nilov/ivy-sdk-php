<?php

use PHPUnit\Framework\Assert;

it('returns the locale resource', function () {
    $data = [
        'locale' => 'de',
    ];

    Assert::assertInstanceOf(Ivy\Resources\Common\Locale::class, Ivy\Resources\Checkout\Session::make
    ($data)->locale);
});

it('returns the proper locale value', function () {
    $locale = \Ivy\Resources\Common\Locale::make(['locale' => 'de']);

    Assert::assertEquals(\Ivy\Dictionaries\Locale::DE, $locale->getLocale());
});