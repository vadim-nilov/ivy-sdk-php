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
        return $this->map($this->data);
    }

    private function map(array $data): array
    {
        foreach ($data as $k => $resourceItem) {
            if ($resourceItem instanceof ApiResource) {
                $data[$k] = $resourceItem->toArray();
            }

            if ($resourceItem instanceof UnitEnum) {
                $data[$k] = $resourceItem->name;
            }

            if (is_array($resourceItem)) {
                $data[$k] = $this->map($resourceItem);
            }
        }

        return $data;
    }
}
