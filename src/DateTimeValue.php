<?php declare(strict_types=1);

namespace Star\Component\Type;

use DateTimeImmutable;
use DateTimeInterface;

final class DateTimeValue implements Value
{
    private DateTimeInterface $dateTime;

    private function __construct(DateTimeInterface $dateTime)
    {
        $this->dateTime = $dateTime;
    }

    public function acceptValueVisitor(ValueVisitor $visitor): void
    {
        $visitor->visitObjectValue($this->dateTime);
    }

    public function isEmpty(): bool
    {
        return false;
    }

    public function toBool(): bool
    {
        throw NotSupportedTypeConversion::conversionToBoolean($this->toString(), Value::TYPE_DATE_TIME);
    }

    public function toDate(): DateTimeInterface
    {
        return $this->dateTime;
    }

    public function toFloat(): float
    {
        return $this->toInteger();
    }

    public function toInteger(): int
    {
        return $this->dateTime->getTimestamp();
    }

    public function toString(): string
    {
        return $this->dateTime->format(DATE_ISO8601);
    }

    public static function fromString(string $value): Value
    {
        return self::fromDateTime(new DateTimeImmutable($value));
    }

    public static function fromDateTime(DateTimeInterface $value): Value
    {
        return new self($value);
    }
}
