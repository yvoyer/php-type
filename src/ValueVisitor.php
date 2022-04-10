<?php declare(strict_types=1);

namespace Star\Component\Type;

interface ValueVisitor
{
    public function visitNullValue(): void;

    public function visitStringValue(string $value): void;

    public function visitIntegerValue(int $value): void;

    public function visitFloatValue(float $value): void;

    public function visitBooleanValue(bool $value): void;

    public function visitObjectValue(object $value): void;

    public function visitArrayOfStrings(string ...$values): void;

    public function visitArrayOfIntegers(int ...$values): void;

    public function visitArrayOfFloats(float ...$values): void;

    public function visitArrayOfBooleans(bool ...$values): void;

    public function visitArrayOfObjects(object ...$values): void;
}
