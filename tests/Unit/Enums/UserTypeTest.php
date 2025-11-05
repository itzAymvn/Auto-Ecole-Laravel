<?php

namespace Tests\Unit\Enums;

use App\Enums\UserType;
use PHPUnit\Framework\TestCase;

class UserTypeTest extends TestCase
{
    public function test_user_type_has_correct_values(): void
    {
        $values = UserType::values();

        $this->assertCount(3, $values);
        $this->assertContains('student', $values);
        $this->assertContains('instructor', $values);
        $this->assertContains('admin', $values);
    }

    public function test_user_type_labels_are_correct(): void
    {
        $this->assertNotEmpty(UserType::STUDENT->label());
        $this->assertNotEmpty(UserType::INSTRUCTOR->label());
        $this->assertNotEmpty(UserType::ADMIN->label());
    }

    public function test_user_type_check_methods_work(): void
    {
        $this->assertTrue(UserType::STUDENT->isStudent());
        $this->assertFalse(UserType::STUDENT->isInstructor());
        $this->assertFalse(UserType::STUDENT->isAdmin());

        $this->assertTrue(UserType::INSTRUCTOR->isInstructor());
        $this->assertFalse(UserType::INSTRUCTOR->isStudent());
        $this->assertFalse(UserType::INSTRUCTOR->isAdmin());

        $this->assertTrue(UserType::ADMIN->isAdmin());
        $this->assertFalse(UserType::ADMIN->isStudent());
        $this->assertFalse(UserType::ADMIN->isInstructor());
    }
}
