<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\User::factory(10)->create();

        \App\Models\User::factory()->create([
            'fullname' => 'Admin',
            'username' => 'admin',
            'email' => 'admin@mail.com',
            'password' => 'admin1234',
            'type' => 'Admin',
            'profile' => '',
        ]);

        \App\Models\User::factory()->create([
            'fullname' => 'Instructor',
            'username' => 'instructor',
            'email' => 'instructor@mail.com',
            'password' => 'instructor1234',
            'type' => 'Instructor',
            'profile' => '',
        ]);

        \App\Models\User::factory()->create([
            'fullname' => 'Student',
            'username' => 'student',
            'email' => 'student@mail.com',
            'password' => 'student1234',
            'type' => 'Student',
            'profile' => '',
        ]);
    }
}
