<?php declare(strict_types=1);

namespace Star\Component\Type\Tests;

use PHPUnit\Framework\TestCase;
use Star\Component\Type\NotSupportedValueType;
use Star\Component\Type\ValueGuesser;

final class ValueGuesserTest extends TestCase
{
    /**
     * @param mixed $value
     * @param int $expected
     * @dataProvider provideToIntegerValues
     */
    public function test_it_should_mixed_to_integer($value, int $expected): void
    {
        self::assertSame($expected, ValueGuesser::fromMixed($value)->toInteger());
    }

    public static function provideToIntegerValues(): array
    {
        return [
            'int-max to int' => [PHP_INT_MAX, PHP_INT_MAX],
            'int-min to int' => [PHP_INT_MIN, PHP_INT_MIN],
            'float to int' => [12.0, 12],
            'true to int' => [true, 1],
            'false to int' => [false, 0],
            'string-int to int' => ['123', 123],
            'string-float to int' => ['123.0', 123],
        ];
    }

    /**
     * @param $value
     * @param string $expectedString
     * @dataProvider provideToStringValues
     */
    public function test_it_should_support_mixed_value_to_string($value, string $expectedString): void
    {
        self::assertSame(
            $expectedString,
            ValueGuesser::fromMixed($value)->toString()
        );
    }

    public static function provideToStringValues(): array
    {
        return [
            'int-max to string' => [PHP_INT_MAX, (string) PHP_INT_MAX],
            'int-min to string' => [PHP_INT_MIN, (string) PHP_INT_MIN],
            'float-max to string' => [PHP_FLOAT_MAX, (string) PHP_FLOAT_MAX],
            'float-min to string' => [PHP_FLOAT_MIN, (string) PHP_FLOAT_MIN],
            'true to string' => [true, '1'],
            'false to string' => [false, '0'],
            'string to string' => ['string', 'string'],
        ];
    }

    /**
     * @param $value
     * @param float $expected
     * @dataProvider provideToFloatValues
     */
    public function test_it_should_support_mixed_to_float($value, float $expected): void
    {
        self::assertSame($expected, ValueGuesser::fromMixed($value)->toFloat());
    }

    public static function provideToFloatValues(): array
    {
        return [
            'int-max to float' => [PHP_INT_MAX, PHP_INT_MAX],
            'int-min to float' => [PHP_INT_MIN, PHP_INT_MIN],
            'float-max to float' => [PHP_FLOAT_MAX, PHP_FLOAT_MAX],
            'float-min to float' => [PHP_FLOAT_MIN, PHP_FLOAT_MIN],
            'true to float' => [true, 1.0],
            'false to float' => [false, 0.0],
            'string-float to float' => ['12.34', 12.34],
            'string-int to float' => ['12', 12.0],
        ];
    }

    /**
     * @param $value
     * @param bool $expected
     * @dataProvider provideToBoolValues
     */
    public function test_it_should_support_mixed_to_boolean($value, bool $expected): void
    {
        self::assertSame($expected, ValueGuesser::fromMixed($value)->toBool());
    }

    public static function provideToBoolValues(): array
    {
        return [
            'int-max to bool' => [0, false],
            'int-min to bool' => [1, true],
            'float-max to bool' => ['0.0', false],
            'float-min to bool' => ['1.0', true],
            'true to bool' => [true, true],
            'false to bool' => [false, false],
        ];
    }

    public function test_it_should_not_support_object(): void
    {
        $this->expectException(NotSupportedValueType::class);
        $this->expectExceptionMessage('Value of type "object(stdClass)" is not supported yet.');
        ValueGuesser::fromMixed((object) []);
    }

    public function test_it_should_not_support_array(): void
    {
        $this->expectException(NotSupportedValueType::class);
        $this->expectExceptionMessage('Value of type "array" is not supported yet.');
        ValueGuesser::fromMixed([]);
    }

    public function test_it_should_not_support_callable(): void
    {
        $this->expectException(NotSupportedValueType::class);
        $this->expectExceptionMessage('Value of type "object(Closure)" is not supported yet.');
        ValueGuesser::fromMixed(function () {});
    }
}
