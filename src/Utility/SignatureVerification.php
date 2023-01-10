<?php

namespace Ivy\Utility;

final class SignatureVerification
{
    public static function verify(string $headerValue, string $data, string $key): bool
    {
        return self::sign($data, $key) === $headerValue;
    }

    public static function sign(string $data, string $key): string
    {
        return hash_hmac('sha256', $data, $key);
    }
}