<?php

namespace Ivy\Utility;

final class SignatureVerification
{
    public function verify(string $headerValue, string $data, string $key): bool
    {
        return $this->sign($data, $key) === $headerValue;
    }

    public function sign(string $data, string $key): string
    {
        return hash_hmac('sha256', $data, $key);
    }
}