<?php declare(strict_types=1);

namespace Star\Component\Type;

use function floatval;
use function in_array;
use function intval;
use function is_numeric;
use function mb_strlen;

final class StringValue implements Value
{
    private string $value;

    private function __construct(string $value)
    {
        $this->value = $value;
    }

    public function toString(): string
    {
        return $this->value;
    }

    public function toFloat(): float
    {
        if (is_numeric($this->value)) {
            return floatval($this->value);
        }

        throw NotSupportedTypeConversion::create($this->toString(), 'string', 'float');
    }

    public function toInteger(): int
    {
        if (is_numeric($this->value) && (int) $this->value == $this->value) {
            return intval($this->value);
        }

        throw NotSupportedTypeConversion::create($this->toString(), 'string', 'integer');
    }

    public function toBool(): bool
    {
        if (in_array($this->value, ['0', '1'])) {
            return (bool) $this->value;
        }

        throw NotSupportedTypeConversion::create($this->toString(), 'string', 'bool');
    }

    public function isEmpty(): bool
    {
        return mb_strlen($this->value) === 0;
    }

    public function acceptValueVisitor(ValueVisitor $visitor): void
    {
        $visitor->visitStringValue($this->value);
    }

    public static function fromString(string $value): Value
    {
        return new self($value);
    }
}
