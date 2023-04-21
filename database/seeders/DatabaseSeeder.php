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

        // some Instructors
        User::create([
            'name' => 'Anaïs Van der Veken',
            'email' => 'anais@gmail.com',
            'phone' => '0623100783',
            'address' => 'Rue druxelles',
            'birthdate' => '2002-07-06',
            'password' => bcrypt('msn@10911'),
            'type' => 'instructor',
        ]);

        User::create([
            'name' => 'Mehdi Ben Amor',
            'email' => 'mehdi@mail.ru',
            'phone' => '0623100783',
            'address' => 'Rue druxelles',
            'birthdate' => '2002-07-06',
            'password' => bcrypt('msn@10911'),
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

        /*
         $table->id();
            $table->foreignId('instructor_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('vehicle_id')->constrained('vehicles')->onDelete('cascade');
            $table->enum('exam_type', ['drive', 'code']);
            $table->string('exam_title');
            $table->date('exam_date');
            $table->time('exam_time');
            $table->string('exam_location');
            $table->timestamps();
        */
        
        // some exams (with pivot table) (no factory)
        $exam1 = Exam::create([
            'exam_type' => 'drive',
            'exam_title' => 'Exam 2',
            'exam_date' => '2021-07-06',
            'exam_time' => '10:00:00',
            'exam_location' => 'Rue de la Paix, 1000 Bruxelles',
            'instructor_id' => 2,
            'vehicle_id' => 2,
        ]);

        $exam1->user()->attach([1, 2, 3, 4, 5]);

        $exam2 = Exam::create([
            'exam_type' => 'code',
            'exam_title' => 'Exam 3',
            'exam_date' => '2021-07-06',
            'exam_time' => '10:00:00',
            'exam_location' => 'Rue de la Paix, 1000 Bruxelles',
            'instructor_id' => 2,
            'vehicle_id' => 2,
        ]);

        $exam2->user()->attach([6, 7, 8, 9, 10]);   


    }
}
