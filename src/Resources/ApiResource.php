<?php

namespace Ivy\Resources;

class ApiResource
{
    final private function __construct(protected array $data)
    {
    }

    public static function make(array $data): static
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

    public function all(): array
    {
        return $this->data;
    }
}
