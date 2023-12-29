<?php declare(strict_types=1);

namespace Star\Component\Type\Tests;

use PHPUnit\Framework\TestCase;
use Star\Component\Type\IntegerValue;
use Star\Component\Type\NotSupportedTypeConversion;
use Star\Component\Type\ValueVisitor;

final class IntegerValueTest extends TestCase
{
    public function test_it_should_create_from_int(): void
    {
        $value = IntegerValue::fromInteger($expected = \mt_rand());
        self::assertSame($expected, $value->toInteger());
        self::assertSame((string) $expected, $value->toString());
        self::assertSame((float) $expected, $value->toFloat());
        self::assertFalse($value->isEmpty());
    }

    public function test_it_should_not_allow_conversion_to_bool_when_not_one_or_zero(): void
    {
        $this->expectException(NotSupportedTypeConversion::class);
        $this->expectExceptionMessage('Conversion of value "2" from "integer" to "boolean" is not allowed.');
        IntegerValue::fromInteger(2)->toBool();
    }

    public function test_it_should_allow_conversion_to_bool_when_boolean_int(): void
    {
        self::assertTrue(IntegerValue::fromInteger(1)->toBool());
        self::assertFalse(IntegerValue::fromInteger(0)->toBool());
    }

    public function test_it_should_visit_value(): void
    {
        $value = IntegerValue::fromInteger(123);
        $visitor = $this->createMock(ValueVisitor::class);
        $visitor
            ->expects(self::once())
            ->method('visitIntegerValue')
            ->with(123);

        $value->acceptValueVisitor($visitor);
    }

    public function test_it_should_not_allow_conversion_to_date(): void
    {
        $this->expectException(NotSupportedTypeConversion::class);
        $this->expectExceptionMessage('Conversion of value "12" from "integer" to "datetime" is not allowed.');
        IntegerValue::fromInteger(12)->toDate();
    }
}
