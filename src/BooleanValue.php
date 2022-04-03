<?php declare(strict_types=1);

namespace Star\Component\Type;

final class BooleanValue implements Value
{
    private bool $value;

    private function __construct(bool $value)
    {
        $this->value = $value;
    }

    public function toString(): string
    {
        return ($this->value) ? '1' : '0';
    }

    public function toFloat(): float
    {
        return (float) $this->toInteger();
    }

    public function toInteger(): int
    {
        return ($this->value) ? 1 : 0;
    }

    public function toBool(): bool
    {
        return $this->value;
    }

    public function isEmpty(): bool
    {
        return false;
    }

    public static function fromBoolean(bool $value): Value
    {
        return new self($value);
    }
}
