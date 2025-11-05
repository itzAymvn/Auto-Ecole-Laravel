<?php

namespace App\Enums;

/**
 * User Type Enum
 *
 * Defines the different types of users in the system.
 */
enum UserType: string
{
    case STUDENT = 'student';
    case INSTRUCTOR = 'instructor';
    case ADMIN = 'admin';

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
            self::STUDENT => __('Student'),
            self::INSTRUCTOR => __('Instructor'),
            self::ADMIN => __('Administrator'),
        };
    }

    /**
     * Check if user is a student
     *
     * @return bool
     */
    public function isStudent(): bool
    {
        return $this === self::STUDENT;
    }

    /**
     * Check if user is an instructor
     *
     * @return bool
     */
    public function isInstructor(): bool
    {
        return $this === self::INSTRUCTOR;
    }

    /**
     * Check if user is an admin
     *
     * @return bool
     */
    public function isAdmin(): bool
    {
        return $this === self::ADMIN;
    }
}
