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
}
