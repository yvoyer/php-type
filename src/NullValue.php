<?php declare(strict_types=1);

namespace Star\Component\Type;

final class NullValue implements Value
{
    public function toString(): string
    {
        return '';
    }

    public function toFloat(): float
    {
        throw NotSupportedTypeConversion::create('NULL', 'null', 'float');
    }

    public function toInteger(): int
    {
        throw NotSupportedTypeConversion::create('NULL', 'null', 'integer');
    }

    public function toBool(): bool
    {
        throw NotSupportedTypeConversion::create('NULL', 'null', 'bool');
    }

    public function isEmpty(): bool
    {
        return true;
    }

    public function acceptValueVisitor(ValueVisitor $visitor): void
    {
        $visitor->visitNullValue();
    }
}
