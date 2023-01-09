<?php

namespace Ivy\Utility;

final class SignatureVerification
{
    public function sign(string $data, string $secret): string
    {
        return hash_hmac('sha256', $data, $secret);
    }
}