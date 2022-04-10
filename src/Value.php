<?php declare(strict_types=1);

namespace Star\Component\Type;

interface Value
{
    /**
     * @return string
     * @throws NotSupportedTypeConversion
     */
    public function toString(): string;

    /**
     * @return float
     * @throws NotSupportedTypeConversion
     */
    public function toFloat(): float;

    /**
     * @return int
     * @throws NotSupportedTypeConversion
     */
    public function toInteger(): int;

    /**
     * @return bool
     * @throws NotSupportedTypeConversion
     */
    public function toBool(): bool;

    /**
     * @return bool
     */
    public function isEmpty(): bool;

    public function acceptValueVisitor(ValueVisitor $visitor): void;
}
