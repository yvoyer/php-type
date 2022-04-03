<?php declare(strict_types=1);

namespace Star\Component\Type;

use function boolval;
use function floatval;
use function in_array;
use function strval;

final class IntegerValue implements Value
{
    private int $value;

    private function __construct(int $value)
    {
        $this->value = $value;
    }

    public function toString(): string
    {
        return strval($this->value);
    }

    public function toFloat(): float
    {
        return floatval($this->value);
    }

    public function toInteger(): int
    {
        return $this->value;
    }

    public function toBool(): bool
    {
        if (in_array($this->value, [1, 0])) {
            return boolval($this->value);
        }

        throw NotSupportedTypeConversion::create($this->toString(), 'integer', 'bool');
    }

    public function isEmpty(): bool
    {
        return false;
    }

    public static function fromInteger(int $value): Value
    {
        return new self($value);
    }
}
