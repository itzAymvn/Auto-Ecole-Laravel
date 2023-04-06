<?php

namespace Database\Factories;

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
            'date' => $this->faker->date(),
            'time' => $this->faker->time(),
            'location' => $this->faker->address,
            'instructor_id' => User::where('type', 'Instructor')->inRandomOrder()->first()->id,
            'student_id' => User::where('type', 'Student')->inRandomOrder()->first()->id,
            'vehicle_id' => Vehicle::inRandomOrder()->first()->id,
        ];
    }
}
