<?php declare(strict_types=1);

namespace Star\Component\Type\Tests;

use DateTimeImmutable;
use DateTimeInterface;
use Star\Component\Type\DateTimeValue;
use PHPUnit\Framework\TestCase;
use Star\Component\Type\NotSupportedTypeConversion;
use Star\Component\Type\ValueVisitor;

final class DateTimeValueTest extends TestCase
{
    public function test_it_should_not_allow_converting_to_float(): void
    {
        $value = DateTimeValue::fromDateTime(new DateTimeImmutable('2000-01-02'));
        self::assertSame(946771200.0, $value->toFloat());
    }

    public function test_it_should_return_timestamp_as_integer(): void
    {
        $value = DateTimeValue::fromDateTime(new DateTimeImmutable('2000-01-02'));
        self::assertSame(946771200, $value->toInteger());
    }

    public function test_it_should_not_allow_converting_to_bool(): void
    {
        $value = DateTimeValue::fromDateTime(new DateTimeImmutable('2000-01-02'));
        $this->expectException(NotSupportedTypeConversion::class);
        $this->expectExceptionMessage(
            'Conversion of value "2000-01-02T00:00:00+0000" from "datetime" to "boolean" is not allowed.'
        );
        $value->toBool();
    }

    public function test_it_should_return_generic_time_format(): void
    {
        $value = DateTimeValue::fromDateTime(new DateTimeImmutable('2000-01-02'));
        self::assertSame('2000-01-02T00:00:00+0000', $value->toString());
    }

    public function test_it_should_visit_value(): void
    {
        $value = DateTimeValue::fromDateTime(new DateTimeImmutable('2000-01-02'));
        $visitor = $this->createMock(ValueVisitor::class);
        $visitor
            ->expects(self::once())
            ->method('visitObjectValue')
            ->with(self::isInstanceOf(DateTimeInterface::class));

        $value->acceptValueVisitor($visitor);
    }

    public function test_it_should_always_be_not_empty(): void
    {
        $value = DateTimeValue::fromString('2000-01-02');
        self::assertFalse($value->isEmpty());
    }

    public function test_it_should_allow_date_value(): void
    {
        self::assertSame(
            '2000-01-01 01:23:45',
            DateTimeValue::fromString('2000-01-01 01:23:45')->toDate()->format('Y-m-d H:i:s')
        );
    }
}
