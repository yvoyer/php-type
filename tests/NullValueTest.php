<?php declare(strict_types=1);

namespace Star\Component\Type\Tests;

use Star\Component\Type\NotSupportedTypeConversion;
use Star\Component\Type\NullValue;
use PHPUnit\Framework\TestCase;
use Star\Component\Type\ValueVisitor;

final class NullValueTest extends TestCase
{
    public function test_it_should_be_considered_empty(): void
    {
        $value = new NullValue();
        self::assertSame('', $value->toString());
        self::assertTrue($value->isEmpty());
    }

    public function test_it_should_not_allow_to_convert_to_float(): void
    {
        $value = new NullValue();
        $this->expectException(NotSupportedTypeConversion::class);
        $this->expectExceptionMessage('Conversion of value "NULL" from "null" to "float" is not allowed.');
        $value->toFloat();
    }

    public function test_it_should_not_allow_to_convert_to_int(): void
    {
        $value = new NullValue();
        $this->expectException(NotSupportedTypeConversion::class);
        $this->expectExceptionMessage('Conversion of value "NULL" from "null" to "integer" is not allowed.');
        $value->toInteger();
    }

    public function test_it_should_not_allow_to_convert_to_bool(): void
    {
        $value = new NullValue();
        $this->expectException(NotSupportedTypeConversion::class);
        $this->expectExceptionMessage('Conversion of value "NULL" from "null" to "boolean" is not allowed.');
        $value->toBool();
    }

    public function test_it_should_visit_value(): void
    {
        $value = new NullValue();
        $visitor = $this->createMock(ValueVisitor::class);
        $visitor
            ->expects(self::once())
            ->method('visitNullValue');

        $value->acceptValueVisitor($visitor);
    }

    public function test_it_should_not_allow_conversion_to_date(): void
    {
        $this->expectException(NotSupportedTypeConversion::class);
        $this->expectExceptionMessage('Conversion of value "NULL" from "null" to "datetime" is not allowed.');
        (new NullValue())->toDate();
    }
}
