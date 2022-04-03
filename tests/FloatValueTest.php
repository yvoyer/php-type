<?php declare(strict_types=1);

namespace Star\Component\Type\Tests;

use PHPUnit\Framework\TestCase;
use Star\Component\Type\FloatValue;
use Star\Component\Type\NotSupportedTypeConversion;

final class FloatValueTest extends TestCase
{
    public function test_it_should_create_from_float(): void
    {
        self::assertSame(12.34, FloatValue::fromFloat(12.34)->toFloat());
        self::assertSame('12.34', FloatValue::fromFloat(12.34)->toString());
        self::assertFalse(FloatValue::fromFloat(12.34)->isEmpty());
    }

    public function test_should_not_allow_conversion_to_bool_when_not_zero_or_one(): void
    {
        $this->expectException(NotSupportedTypeConversion::class);
        $this->expectExceptionMessage('Conversion of value "12.34" from "float" to "bool" is not allowed.');
        FloatValue::fromFloat(12.34)->toBool();
    }

    public function test_should_not_allow_conversion_to_int_when_decimal_present(): void
    {
        $this->expectException(NotSupportedTypeConversion::class);
        $this->expectExceptionMessage('Conversion of value "12.34" from "float" to "integer" is not allowed.');
        FloatValue::fromFloat(12.34)->toInteger();
    }

    public function test_it_should_allow_float_without_decimal_to_int_conversion(): void
    {
        self::assertSame(12, FloatValue::fromFloat(12.0)->toInteger());
    }
}
