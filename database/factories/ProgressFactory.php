<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Progress>
 */
class ProgressFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'student_id' => User::where('type', 'Student')->inRandomOrder()->first()->id,
            'progress_status' => $this->faker->randomElement(['pending', 'approved', 'rejected']),
            'notes' => $this->faker->paragraph(
                $nbSentences = 3,
                $variableNbSentences = true
            ),
        ];
    }
}
