<?php

namespace Tests\Feature;

use App\Enums\ExamType;
use App\Enums\UserType;
use App\Models\Exam;
use App\Models\User;
use App\Models\Vehicle;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExamManagementTest extends TestCase
{
    use RefreshDatabase;

    protected User $admin;

    protected User $instructor;

    protected function setUp(): void
    {
        parent::setUp();
        $this->admin = User::factory()->create(['type' => UserType::ADMIN]);
        $this->instructor = User::factory()->create(['type' => UserType::INSTRUCTOR]);
    }

    public function test_admin_can_view_exams_list(): void
    {
        $response = $this->actingAs($this->admin)->get('/dashboard/exams');

        $response->assertStatus(200);
    }

    public function test_admin_can_create_exam(): void
    {
        $vehicle = Vehicle::factory()->create();

        $examData = [
            'instructor_id' => $this->instructor->id,
            'vehicle_id' => $vehicle->id,
            'exam_type' => ExamType::DRIVE->value,
            'exam_title' => 'Driving Test',
            'exam_date' => now()->addDays(7)->format('Y-m-d'),
            'exam_time' => '10:00',
            'exam_location' => 'Test Location',
        ];

        $response = $this->actingAs($this->admin)->post('/dashboard/exams', $examData);

        $this->assertDatabaseHas('exams', [
            'exam_title' => 'Driving Test',
            'instructor_id' => $this->instructor->id,
        ]);
    }

    public function test_exam_creation_validates_required_fields(): void
    {
        $response = $this->actingAs($this->admin)->post('/dashboard/exams', []);

        $response->assertSessionHasErrors([
            'instructor_id',
            'exam_type',
            'exam_title',
            'exam_date',
            'exam_time',
            'exam_location',
        ]);
    }

    public function test_students_can_be_added_to_exam(): void
    {
        $exam = Exam::factory()->create([
            'instructor_id' => $this->instructor->id,
        ]);

        $student = User::factory()->create(['type' => UserType::STUDENT]);

        $exam->user()->attach($student->id);

        $this->assertDatabaseHas('exam_user', [
            'exam_id' => $exam->id,
            'user_id' => $student->id,
        ]);
    }
}
