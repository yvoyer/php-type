<?php declare(strict_types=1);

namespace Star\Component\Type;

use DateTimeInterface;

final class BooleanValue implements Value
{
    private bool $value;

    private function __construct(bool $value)
    {
        $this->value = $value;
    }

    public function acceptValueVisitor(ValueVisitor $visitor): void
    {
        $visitor->visitBooleanValue($this->value);
    }

    public function isEmpty(): bool
    {
        return false;
    }

    public function toBool(): bool
    {
        return $this->value;
    }

    public function toDate(): DateTimeInterface
    {
        throw NotSupportedTypeConversion::conversionToDate(
            ($this->value) ? 'true': 'false',
            self::TYPE_BOOLEAN
        );
    }

    public function toFloat(): float
    {
        return (float) $this->toInteger();
    }

    public function toInteger(): int
    {
        return ($this->value) ? 1 : 0;
    }

    public function toString(): string
    {
        return ($this->value) ? '1' : '0';
    }

    public static function fromBoolean(bool $value): Value
    {
        return new self($value);
    }

    public static function asTrue(): Value
    {
        return self::fromBoolean(true);
    }

    public static function asFalse(): Value
    {
        return self::fromBoolean(false);
    }
}
