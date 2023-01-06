<?php

namespace Ivy\Resources\Common;

use Ivy\Dictionaries\Locale as LocaleDictionary;
use Ivy\Resources\ApiResource;

final class Locale extends ApiResource
{
    public function getLocale(): LocaleDictionary
    {
        if (isset($this->data['locale'])) {
            $locale = strtoupper($this->data['locale']);

            return constant("Ivy\Dictionaries\Locale::$locale");
        }

        return LocaleDictionary::EN;
    }
}