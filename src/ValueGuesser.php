<?php declare(strict_types=1);

namespace Star\Component\Type;

use DateTimeInterface;
use function get_class;
use function gettype;
use function is_bool;
use function is_null;
use function is_numeric;
use function is_object;
use function is_string;
use function sprintf;

final class ValueGuesser
{
    /**
     * @param mixed $value
     * @return Value
     */
    public static function fromMixed($value): Value
    {
        if (is_null($value)) {
            return new NullValue();
        }

        if (is_numeric($value)) {
            if ((int) $value == $value) {
                return IntegerValue::fromInteger((int) $value);
            }

            return FloatValue::fromFloat((float) $value);
        }

        if (is_bool($value)) {
            return BooleanValue::fromBoolean($value);
        }

        if (is_string($value)) {
            return StringValue::fromString($value);
        }

        if ($value instanceof DateTimeInterface) {
            return DateTimeValue::fromDateTime($value);
        }

        $type = gettype($value);
        if (is_object($value)) {
            $type = sprintf('object(%s)', get_class($value));
        }

        throw new NotSupportedValueType(
            sprintf(
                'Value of type "%s" is not supported yet.',
                $type
            )
        );
    }
}
