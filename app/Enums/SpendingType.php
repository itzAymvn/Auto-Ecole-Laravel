<?php

namespace App\Enums;

/**
 * Spending Type Enum
 *
 * Defines the different types of expenses in the system.
 */
enum SpendingType: string
{
    case SALARY = 'salary';
    case OTHER = 'other';

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
            self::SALARY => __('Salary'),
            self::OTHER => __('Other Expense'),
        };
    }

    /**
     * Check if spending is a salary
     *
     * @return bool
     */
    public function isSalary(): bool
    {
        return $this === self::SALARY;
    }

    /**
     * Check if spending is other type
     *
     * @return bool
     */
    public function isOther(): bool
    {
        return $this === self::OTHER;
    }
}
