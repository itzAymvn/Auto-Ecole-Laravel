<?php

namespace Database\Seeders;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Admin User
        User::create([
            'name' => 'Admin',
            'email' => 'admin@mail.com',
            'phone' => '0123456789',
            'address' => 'Rue de la Paix, 1000 Bruxelles',
            'birthdate' => '1999-12-30',
            'password' => bcrypt('password'),
            'type' => 'admin',
        ]);

        User::create([
            'name' => 'Admin 2',
            'email' => 'admin2@mail.com',
            'phone' => '0123456780',
            'address' => 'Le chemin de la vie',
            'birthdate' => '2002-12-30',
            'password' => bcrypt('password'),
            'type' => 'admin',
        ]);


        // Instructor Users
        User::create([
            'name' => 'Instructor 1',
            'email' => 'instructor1@mail.com',
            'phone' => '0123456789',
            'address' => 'Rue druxelles',
            'birthdate' => '1999-12-30',
            'password' => bcrypt('password'),
            'type' => 'instructor',
        ]);

        User::create([
            'name' => 'Instructor 2',
            'email' => 'instructor2@mail.com',
            'phone' => '0123456789',
            'address' => 'Rue druxelles',
            'birthdate' => '1999-12-30',
            'password' => bcrypt('password'),
            'type' => 'instructor',
        ]);

        // Additional users
        $startCreationDate = Carbon::now()->subDays(30); // Set the starting creation date

        for ($i = 0; $i < 30; $i++) {
            User::factory()->create([
                'created_at' => $startCreationDate->addDays($i),
                // Additional attributes for the User model
            ]);
        }
    }
}
