<?php declare(strict_types=1);

namespace Star\Component\Type\Tests;

use PHPUnit\Framework\TestCase;
use Star\Component\Type\NotSupportedTypeConversion;
use Star\Component\Type\StringValue;

final class StringValueTest extends TestCase
{
    public function test_it_should_check_for_empty(): void
    {
        self::assertFalse(StringValue::fromString('string')->isEmpty());
        self::assertTrue(StringValue::fromString('')->isEmpty());
    }

    public function test_it_should_create_from_string(): void
    {
        self::assertSame('string', StringValue::fromString('string')->toString());
    }

    public function test_it_should_allow_conversion_to_float_when_value_is_float_string(): void
    {
        self::assertSame(123.45, StringValue::fromString('123.45')->toFloat());
    }

    public function test_it_should_not_allow_conversion_to_float(): void
    {
        $this->expectException(NotSupportedTypeConversion::class);
        $this->expectExceptionMessage('Conversion of value "string" from "string" to "float" is not allowed.');
        StringValue::fromString('string')->toFloat();
    }

    public function test_it_should_allow_conversion_to_int_when_value_is_int_string(): void
    {
        self::assertSame(123, StringValue::fromString('123')->toInteger());
    }

    public function test_it_should_not_allow_conversion_to_int(): void
    {
        $this->expectException(NotSupportedTypeConversion::class);
        $this->expectExceptionMessage('Conversion of value "string" from "string" to "integer" is not allowed.');
        StringValue::fromString('string')->toInteger();
    }

    public function test_it_should_not_allow_conversion_to_bool(): void
    {
        $this->expectException(NotSupportedTypeConversion::class);
        $this->expectExceptionMessage('Conversion of value "string" from "string" to "bool" is not allowed.');
        StringValue::fromString('string')->toBool();
    }

    public function test_it_should_not_allow_conversion_to_bool_when_value_is_bool_string(): void
    {
        self::assertTrue(StringValue::fromString('1')->toBool());
        self::assertFalse(StringValue::fromString('0')->toBool());
    }

    public function test_it_should_not_allow_conversion_to_int_when_float_string(): void
    {
        $this->expectException(NotSupportedTypeConversion::class);
        $this->expectExceptionMessage('Conversion of value "12.34" from "string" to "integer" is not allowed.');
        StringValue::fromString('12.34')->toInteger();
    }
}
