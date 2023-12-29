<?php declare(strict_types=1);

namespace Star\Component\Type;

use RuntimeException;
use function sprintf;

final class NotSupportedTypeConversion extends RuntimeException
{
    public static function create(string $value, string $from, string $to): self
    {
        return new self(
            sprintf(
                'Conversion of value "%s" from "%s" to "%s" is not allowed.',
                $value,
                $from,
                $to
            )
        );
    }

    public static function conversionToBoolean(string $value, string $from): self
    {
        return self::create($value, $from, Value::TYPE_BOOLEAN);
    }

    public static function conversionToDate(string $value, string $from): self
    {
        return self::create($value, $from, Value::TYPE_DATE_TIME);
    }

    public static function conversionToFloat(string $value, string $from): self
    {
        return self::create($value, $from, Value::TYPE_FLOAT);
    }

    public static function conversionToInteger(string $value, string $from): self
    {
        return self::create($value, $from, Value::TYPE_INTEGER);
    }

    public static function conversionToNull(string $value, string $from): self
    {
        return self::create($value, $from, Value::TYPE_NULL);
    }

    public static function conversionToString(string $value, string $from): self
    {
        return self::create($value, $from, Value::TYPE_STRING);
    }
}
