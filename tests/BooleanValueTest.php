<?php declare(strict_types=1);

namespace Star\Component\Type\Tests;

use PHPUnit\Framework\TestCase;
use Star\Component\Type\BooleanValue;
use Star\Component\Type\NotSupportedTypeConversion;

final class BooleanValueTest extends TestCase
{
    public function test_it_should_create_from_bool(): void
    {
        self::assertTrue(BooleanValue::fromBoolean(true)->toBool());
        self::assertSame(1, BooleanValue::fromBoolean(true)->toInteger());
        self::assertSame(1.0, BooleanValue::fromBoolean(true)->toFloat());
        self::assertSame('1', BooleanValue::fromBoolean(true)->toString());
        self::assertFalse(BooleanValue::fromBoolean(true)->isEmpty());
        self::assertFalse(BooleanValue::fromBoolean(false)->isEmpty());
    }
}
