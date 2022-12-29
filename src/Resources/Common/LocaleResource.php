<?php

namespace Ivy\Resources\Common;

use Ivy\Dictionaries\Locale;
use Ivy\Resources\ApiResource;

final class LocaleResource extends ApiResource
{
    public function getLocale(): Locale
    {
        if (isset($this->data['locale'])) {
            $locale = strtolower($this->data['locale']);

            return constant("Ivy\Dictionaries\Locale::$locale");
        }

        return Locale::en;
    }

    public function setLocale(Locale $locale): void
    {
        $this->data['locale'] = $locale->name;
    }
}