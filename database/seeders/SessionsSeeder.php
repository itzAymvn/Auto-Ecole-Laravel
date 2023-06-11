<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Session;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SessionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        /*
        Schema::create('sessions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('instructor_id')->constrained('users')->onDelete('cascade');
            // $table->foreignId('vehicle_id')->constrained('vehicles')->onDelete('cascade');
            $table->string('title', 100);
            $table->date('session_date');
            $table->time('session_time');
            $table->string('session_location', 100);
            $table->boolean('is_completed')->default(false);
            $table->timestamps();
        });
        Schema::create('session_user', function (Blueprint $table) {
            $table->id();
            $table->foreignId('session_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->boolean('attended')->nullable();
            $table->timestamps();
        });
        */

        // Get all existing users
        $instructors = User::where('type', 'instructor')->get();

        // Create sessions
        $sessions = [
            [
                'instructor_id' => $instructors->random()->id,
                'title' => 'Session 1',
                'session_date' => date('Y-m-d'),
                'session_time' => '09:00:00',
                'session_location' => 'Location 1',
                'is_completed' => false,
            ],
            [
                'instructor_id' => $instructors->random()->id,
                'title' => 'Session 2',
                'session_date' => date('Y-m-d', strtotime('+1 day')),
                'session_time' => '14:30:00',
                'session_location' => 'Location 2',
                'is_completed' => false,
            ],
            // Add more sessions as needed
        ];

        // Create the sessions
        foreach ($sessions as $sessionData) {
            Session::create($sessionData);
        }

        // Attach 10 random students to each session (the student should not be attached to the same session more than once, and can't have multiple sessions at the same time)
        $sessions = Session::all();
        $students = User::where('type', 'student')->get();
        foreach ($sessions as $session) {
            $session->user()->attach($students->random(10));
        }
    }
}
