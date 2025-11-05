<?php

namespace Database\Factories;

use App\Enums\UserType;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'phone' => fake()->regexify('[0-9]{10}'),
            'address' => fake()->address(),
            'birthdate' => fake()->date(),
            'password' => Hash::make('password'),
            'type' => UserType::STUDENT,
            'image' => null,
        ];
    }

    /**
     * Indicate that the user is an instructor.
     */
    public function instructor(): static
    {
        return $this->state(fn (array $attributes) => [
            'type' => UserType::INSTRUCTOR,
        ]);
    }

    /**
     * Indicate that the user is an admin.
     */
    public function admin(): static
    {
        return $this->state(fn (array $attributes) => [
            'type' => UserType::ADMIN,
        ]);
    }
}
