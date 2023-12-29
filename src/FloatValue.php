<?php declare(strict_types=1);

namespace Star\Component\Type;

use DateTimeInterface;
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

    public function acceptValueVisitor(ValueVisitor $visitor): void
    {
        $visitor->visitFloatValue($this->value);
    }

    public function isEmpty(): bool
    {
        return false;
    }

    public function toBool(): bool
    {
        throw NotSupportedTypeConversion::conversionToBoolean($this->toString(), self::TYPE_FLOAT);
    }

    public function toDate(): DateTimeInterface
    {
        throw NotSupportedTypeConversion::conversionToDate($this->toString(), self::TYPE_FLOAT);
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

        throw NotSupportedTypeConversion::conversionToInteger($this->toString(), self::TYPE_FLOAT);
    }

    public function toString(): string
    {
        return strval($this->value);
    }

    public static function fromFloat(float $value): Value
    {
        return new self($value);
    }
}
