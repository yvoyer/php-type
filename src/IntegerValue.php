<?php declare(strict_types=1);

namespace Star\Component\Type;

use DateTimeInterface;
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

    public function acceptValueVisitor(ValueVisitor $visitor): void
    {
        $visitor->visitIntegerValue($this->value);
    }

    public function isEmpty(): bool
    {
        return false;
    }

    public function toBool(): bool
    {
        if (in_array($this->value, [1, 0])) {
            return boolval($this->value);
        }

        throw NotSupportedTypeConversion::conversionToBoolean($this->toString(), self::TYPE_INTEGER);
    }

    public function toDate(): DateTimeInterface
    {
        throw NotSupportedTypeConversion::conversionToDate($this->toString(), self::TYPE_INTEGER);
    }

    public function toFloat(): float
    {
        return floatval($this->value);
    }

    public function toInteger(): int
    {
        return $this->value;
    }

    public function toString(): string
    {
        return strval($this->value);
    }

    public static function fromInteger(int $value): Value
    {
        return new self($value);
    }
}
