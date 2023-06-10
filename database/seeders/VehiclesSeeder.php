<?php

namespace Database\Seeders;

use App\Models\Vehicle;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class VehiclesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Vehicles (matricule and model)
        Vehicle::create([
            'matricule' => '1-ABC-123',
            'model' => 'BMW',
        ]);

        Vehicle::create([
            'matricule' => '1-DEF-456',
            'model' => 'Mercedes',
        ]);

        Vehicle::create([
            'matricule' => '1-GHI-789',
            'model' => 'Audi',
        ]);

        Vehicle::create([
            'matricule' => '1-JKL-012',
            'model' => 'Volkswagen',
        ]);

        Vehicle::create([
            'matricule' => '1-MNO-345',
            'model' => 'Renault',
        ]);

        Vehicle::create([
            'matricule' => '1-PQR-678',
            'model' => 'Peugeot',
        ]);
    }
}
