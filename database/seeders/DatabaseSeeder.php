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

        User::factory(30)->create();
        Vehicle::factory(30)->create();
        Session::factory(30)->create();
        Exam::factory(30)->create();
        Progress::factory(30)->create();
    }
}
