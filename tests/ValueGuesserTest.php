<?php declare(strict_types=1);

namespace Star\Component\Type\Tests;

use PHPUnit\Framework\TestCase;
use Star\Component\Type\NotSupportedValueType;
use Star\Component\Type\ValueGuesser;

final class ValueGuesserTest extends TestCase
{
    public function test_it_should_support_integer(): void
    {
        $value = ValueGuesser::fromMixed(1);
        self::assertSame('1', $value->toString());
        self::assertSame(1, $value->toInteger());
        self::assertSame(1.0, $value->toFloat());
        self::assertTrue($value->toBool());
        self::assertFalse($value->isEmpty());

        $value = ValueGuesser::fromMixed(0);
        self::assertSame('0', $value->toString());
        self::assertSame(0, $value->toInteger());
        self::assertSame(0.0, $value->toFloat());
        self::assertFalse($value->toBool());
        self::assertFalse($value->isEmpty());

        $value = ValueGuesser::fromMixed(2);
        self::assertSame('2', $value->toString());
        self::assertSame(2, $value->toInteger());
        self::assertSame(2.0, $value->toFloat());
        self::assertFalse($value->isEmpty());
    }

    public function test_it_should_support_string(): void
    {
        $value = ValueGuesser::fromMixed('string');
        self::assertSame('string', $value->toString());
        self::assertFalse($value->isEmpty());
    }

    public function test_it_should_support_float(): void
    {
        $value = ValueGuesser::fromMixed(12.34);
        self::assertSame('12.34', $value->toString());
        self::assertSame(12.34, $value->toFloat());
        self::assertFalse($value->isEmpty());
    }

    public function test_it_should_support_boolean(): void
    {
        $value = ValueGuesser::fromMixed(false);
        self::assertSame('0', $value->toString());
        self::assertSame(0, $value->toInteger());
        self::assertSame(0.0, $value->toFloat());
        self::assertFalse($value->toBool());
        self::assertFalse($value->isEmpty());

        $value = ValueGuesser::fromMixed(true);
        self::assertSame('1', $value->toString());
        self::assertSame(1, $value->toInteger());
        self::assertSame(1.0, $value->toFloat());
        self::assertTrue($value->toBool());
        self::assertFalse($value->isEmpty());
    }

    public function test_it_should_not_support_object(): void
    {
        $this->expectException(NotSupportedValueType::class);
        $this->expectExceptionMessage('dsa');
        ValueGuesser::fromMixed((object) []);
    }

    public function test_it_should_not_support_array(): void
    {
        $this->expectException(NotSupportedValueType::class);
        $this->expectExceptionMessage('dsa');
        ValueGuesser::fromMixed([]);
    }

    public function test_it_should_not_support_callable(): void
    {
        $this->expectException(NotSupportedValueType::class);
        $this->expectExceptionMessage('dsa');
        ValueGuesser::fromMixed(function () {});
    }
}
