<?php declare(strict_types=1);

namespace Star\Component\Type;

use DateTimeInterface;

final class DateTimeValue implements Value
{
    private DateTimeInterface $dateTime;

    public function __construct(DateTimeInterface $dateTime)
    {
        $this->dateTime = $dateTime;
    }

    public function toString(): string
    {
        return $this->dateTime->format(DATE_ISO8601);
    }

    public function toFloat(): float
    {
        return $this->toInteger();
    }

    public function toInteger(): int
    {
        return $this->dateTime->getTimestamp();
    }

    public function toBool(): bool
    {
        throw NotSupportedTypeConversion::create($this->toString(), 'datetime', 'boolean');
    }

    public function isEmpty(): bool
    {
        return false;
    }

    public function acceptValueVisitor(ValueVisitor $visitor): void
    {
        $visitor->visitObjectValue($this->dateTime);
    }
}
