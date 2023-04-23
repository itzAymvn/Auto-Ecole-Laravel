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
            'name' => 'Admin',
            'email' => 'admin@mail.com',
            'phone' => '0123456789',
            'address' => 'Rue de la Paix, 1000 Bruxelles',
            'birthdate' => '1999-12-30',
            'password' => bcrypt('password'),
            'type' => 'admin',
        ]);

        // some Instructors
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

        // some vehicles
        Vehicle::create([
            'matricule' => '1-ABC-123',
            'model' => 'Peugeot 208',
        ]);

        Vehicle::create([
            'matricule' => '2-ABC-123',
            'model' => 'Peugeot 308',
        ]);

        // some users
        User::factory(30)->create();

        $exam1 = Exam::create([
            'exam_type' => 'drive',
            'exam_title' => 'Exam 2',
            'exam_date' => '2021-07-06',
            'exam_time' => '10:00:00',
            'exam_location' => 'Rue de la Paix, 1000 Bruxelles',
            'instructor_id' => 2,
            'vehicle_id' => 2,
        ]);

        $exam1->user()->attach([4, 5, 6, 7, 8]);

        $exam2 = Exam::create([
            'exam_type' => 'code',
            'exam_title' => 'Exam 3',
            'exam_date' => '2021-07-06',
            'exam_time' => '10:00:00',
            'exam_location' => 'Rue de la Paix, 1000 Bruxelles',
            'instructor_id' => 2,
            'vehicle_id' => 2,
        ]);

        $exam2->user()->attach([9, 10, 11, 12, 13]);
    }
}
