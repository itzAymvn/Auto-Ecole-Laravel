<?php

namespace App\Enums;

/**
 * Exam Type Enum
 *
 * Defines the different types of exams in the driving school system.
 */
enum ExamType: string
{
    case DRIVE = 'drive';
    case CODE = 'code';

    /**
     * Get all available values
     *
     * @return array<string>
     */
    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }

    /**
     * Get label for display
     *
     * @return string
     */
    public function label(): string
    {
        return match ($this) {
            self::DRIVE => __('Driving Test'),
            self::CODE => __('Code Test'),
        };
    }

    /**
     * Check if exam is a driving test
     *
     * @return bool
     */
    public function isDrive(): bool
    {
        return $this === self::DRIVE;
    }

    /**
     * Check if exam is a code test
     *
     * @return bool
     */
    public function isCode(): bool
    {
        return $this === self::CODE;
    }
}
