<?php declare(strict_types=1);

namespace Star\Component\Type;

use DateTimeInterface;

interface Value
{
    public const TYPE_DATE_TIME = 'datetime';
    public const TYPE_STRING = 'string';
    public const TYPE_INTEGER = 'integer';
    public const TYPE_BOOLEAN = 'boolean';
    public const TYPE_FLOAT = 'float';
    public const TYPE_NULL = 'null';

    public function acceptValueVisitor(ValueVisitor $visitor): void;

    /**
     * @return bool
     */
    public function isEmpty(): bool;

    /**
     * @return bool
     * @throws NotSupportedTypeConversion
     */
    public function toBool(): bool;

    /**
     * @return DateTimeInterface
     * @throws NotSupportedTypeConversion
     */
    public function toDate(): DateTimeInterface;

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
     * @return string
     * @throws NotSupportedTypeConversion
     */
    public function toString(): string;
}
