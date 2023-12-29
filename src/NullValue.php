<?php declare(strict_types=1);

namespace Star\Component\Type;

use DateTimeInterface;

final class NullValue implements Value
{
    public function acceptValueVisitor(ValueVisitor $visitor): void
    {
        $visitor->visitNullValue();
    }

    public function isEmpty(): bool
    {
        return true;
    }

    public function toBool(): bool
    {
        throw NotSupportedTypeConversion::conversionToBoolean('NULL', self::TYPE_NULL);
    }

    public function toDate(): DateTimeInterface
    {
        throw NotSupportedTypeConversion::conversionToDate('NULL', self::TYPE_NULL);
    }

    public function toFloat(): float
    {
        throw NotSupportedTypeConversion::conversionToFloat('NULL', self::TYPE_NULL);
    }

    public function toInteger(): int
    {
        throw NotSupportedTypeConversion::conversionToInteger('NULL', self::TYPE_NULL);
    }

    public function toString(): string
    {
        return '';
    }
}
