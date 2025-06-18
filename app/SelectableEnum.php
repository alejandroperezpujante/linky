<?php

namespace App;

trait SelectableEnum
{
    /**
     * Get array of enum cases formatted for HTML select inputs
     * Returns array with 'value' and 'label' keys for each case
     *
     * @return array<int, array{value: string, label: string}>
     */
    public static function forSelect(): array
    {
        return array_map(function ($case) {
            return [
                'value' => $case->value,
                'label' => self::getLabel($case)
            ];
        }, self::cases());
    }

    /**
     * Get associative array with enum values as keys and labels as values
     * Useful for simple key-value dropdowns
     *
     * @return array<string, string>
     */
    public static function options(): array
    {
        $options = [];
        foreach (self::cases() as $case) {
            $options[$case->value] = self::getLabel($case);
        }
        return $options;
    }

    /**
     * Get human-readable label for an enum case
     * Override this method in your enum to provide custom labels
     *
     * @param self $case
     * @return string
     */
    protected static function getLabel(self $case): string
    {
        // Default: convert snake_case/kebab-case to Title Case
        return str_replace(['_', '-'], ' ', ucwords($case->value, '_-'));
    }
}
