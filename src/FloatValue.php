<?php declare(strict_types=1);

namespace Star\Component\Type;

use function strval;
use function trim;

final class FloatValue implements Value
{
    /**
     * @var float
     */
    private float $value;

    private function __construct(float $value)
    {
        $this->value = $value;
    }

    public function toString(): string
    {
        return strval($this->value);
    }

    public function toFloat(): float
    {
        return $this->value;
    }

    public function toInteger(): int
    {
        if (trim($this->toString(), '0.') == (int) $this->value) {
            return (int) $this->value;
        }

        throw NotSupportedTypeConversion::create($this->toString(), 'float', 'integer');
    }

    public function toBool(): bool
    {
        throw NotSupportedTypeConversion::create($this->toString(), 'float', 'bool');
    }

    public function isEmpty(): bool
    {
        return false;
    }

    public static function fromFloat(float $value): Value
    {
        return new self($value);
    }
}
