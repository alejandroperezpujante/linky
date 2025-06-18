<?php

namespace App;

trait EnumValues
{
    /**
     * Get all enum values as an indexed array.
     *
     * @return array<int, string|int>
     */
    public static function values(): array
    {
        return array_column(
            self::cases(),
            'value'
        );
    }
}
