<?php

namespace Database\Factories;

use App\Models\Vehicle;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Vehicle>
 */
class VehicleFactory extends Factory
{

    protected $model = Vehicle::class;

    /**
     * 
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $carBrands = [
            'Toyota', 'Ford', 'Honda', 'Chevrolet', 'Nissan',
            'Jeep', 'BMW', 'Mercedes-Benz', 'Kia', 'Hyundai',
            'Dodge', 'Volkswagen', 'Audi', 'Lexus', 'Mazda',
            'Subaru', 'Volvo', 'Cadillac', 'GMC', 'Chrysler'
        ];

        return [
            'make' => $this->faker->randomElement($carBrands),
            'model' => $this->faker->word(),
            'year' => $this->faker->numberBetween(2000, 2023),
            'license_plate' => $this->faker->regexify('[A-Z]{3}-[0-9]{4}'),
            'condition' => $this->faker->randomElement(['New', 'Used']),
        ];
    }
}
