<?php

namespace Database\Factories;

use App\Enums\ExamType;
use App\Enums\UserType;
use App\Models\User;
use App\Models\Vehicle;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Exam>
 */
class ExamFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'instructor_id' => User::factory()->create(['type' => UserType::INSTRUCTOR]),
            'vehicle_id' => Vehicle::factory(),
            'exam_type' => fake()->randomElement(ExamType::cases()),
            'exam_title' => fake()->sentence(3),
            'exam_date' => fake()->dateTimeBetween('now', '+1 month'),
            'exam_time' => fake()->time('H:i'),
            'exam_location' => fake()->address(),
        ];
    }
}
