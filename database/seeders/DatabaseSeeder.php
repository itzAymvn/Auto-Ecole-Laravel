<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

// Models
use App\Models\User;
use App\Models\Session;
use App\Models\Progress;
use App\Models\Vehicle;
use App\Models\Exam;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        // 1 admin
        User::create([
            'name' => 'Ayman Badouzi',
            'email' => 'aymanbadouzi@gmail.com',
            'phone' => '0623100773',
            'address' => 'Rue de la Paix, 1000 Bruxelles',
            'birthdate' => '2002-07-06',
            'password' => bcrypt('msn@10911'),
            'type' => 'admin',
        ]);

        // 1 instructor
        User::create([
            'name' => 'Anaïs Van der Veken',
            'email' => 'anais@gmail.com',
            'phone' => '0623100783',
            'address' => 'Rue druxelles',
            'birthdate' => '2002-07-06',
            'password' => bcrypt('msn@10911'),
            'type' => 'instructor',
        ]);

        // 1 vehicle
        Vehicle::create([
            'matricule' => '1-ABC-123',
            'model' => 'Peugeot 208',
        ]);


        User::factory(10)->create();
    }
}
