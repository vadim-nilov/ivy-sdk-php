<?php

namespace Ivy\Resources;

use UnitEnum;

class ApiResource
{
    final private function __construct(protected array $data)
    {
    }

    public static function make(array $data): ApiResource
    {
        return new static(data: $data);
    }

    public function __get(string $name)
    {
        return $this->data[$name] ?? null;
    }

    public function __set(string $name, mixed $value): void
    {
        $this->data[$name] = $value;
    }

    public function toArray(): array
    {
        return array_map(function ($resourceItem) {
            if ($resourceItem instanceof ApiResource) {
                return $resourceItem->toArray();
            }

            if ($resourceItem instanceof UnitEnum) {
                return $resourceItem->name;
            }

            return $resourceItem;
        }, $this->data);
    }
}
