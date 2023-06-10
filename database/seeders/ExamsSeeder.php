<?php

namespace Database\Seeders;

use App\Models\Exam;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ExamsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Exam 1
        $exam1 = Exam::create([
            'exam_type' => 'drive',
            'exam_title' => 'Examen pratique N°1',
            'exam_date' => date('Y-m-d'),
            'exam_time' => '10:00:00',
            'exam_location' => 'Rue de la Paix, 1000 Bruxelles',
            'instructor_id' => 2,
            'vehicle_id' => 2,
        ]);

        $exam1->user()->attach([4, 5, 6, 7, 8]);

        // Exam 2
        $exam2 = Exam::create([
            'exam_type' => 'code',
            'exam_title' => 'Examen théorique N°1',
            'exam_date' => date('Y-m-d', strtotime('+1 day')),
            'exam_time' => '10:00:00',
            'exam_location' => 'Rue de la Paix, 1000 Bruxelles',
            'instructor_id' => 3,
        ]);

        $exam2->user()->attach([9, 10, 11, 12, 13]);

        // Add more exams as needed
    }
}
