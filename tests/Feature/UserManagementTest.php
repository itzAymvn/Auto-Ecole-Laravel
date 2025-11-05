<?php

namespace Tests\Feature;

use App\Enums\UserType;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class UserManagementTest extends TestCase
{
    use RefreshDatabase;

    protected User $admin;

    protected function setUp(): void
    {
        parent::setUp();
        $this->admin = User::factory()->create(['type' => UserType::ADMIN]);
    }

    public function test_admin_can_view_users_list(): void
    {
        $response = $this->actingAs($this->admin)->get('/dashboard/users');

        $response->assertStatus(200);
    }

    public function test_admin_can_create_user(): void
    {
        Storage::fake('public');

        $userData = [
            'name' => 'Test User',
            'email' => 'testuser@example.com',
            'phone' => '0612345678',
            'address' => '123 Test St',
            'birthdate' => '2000-01-01',
            'type' => UserType::STUDENT->value,
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ];

        $response = $this->actingAs($this->admin)->post('/dashboard/users', $userData);

        $this->assertDatabaseHas('users', [
            'email' => 'testuser@example.com',
            'name' => 'Test User',
        ]);
    }

    public function test_user_creation_validates_required_fields(): void
    {
        $response = $this->actingAs($this->admin)->post('/dashboard/users', []);

        $response->assertSessionHasErrors(['name', 'email', 'phone', 'address', 'birthdate', 'type', 'password']);
    }

    public function test_admin_can_update_user(): void
    {
        $user = User::factory()->create(['type' => UserType::STUDENT]);

        $updateData = [
            'name' => 'Updated Name',
            'email' => $user->email,
            'phone' => '0612345678',
            'address' => '456 New St',
            'birthdate' => $user->birthdate->format('Y-m-d'),
            'type' => UserType::STUDENT->value,
        ];

        $response = $this->actingAs($this->admin)->put("/dashboard/users/{$user->id}", $updateData);

        $this->assertDatabaseHas('users', [
            'id' => $user->id,
            'name' => 'Updated Name',
            'address' => '456 New St',
        ]);
    }

    public function test_admin_can_delete_user(): void
    {
        $user = User::factory()->create(['type' => UserType::STUDENT]);

        $response = $this->actingAs($this->admin)->delete("/dashboard/users/{$user->id}");

        $this->assertDatabaseMissing('users', [
            'id' => $user->id,
        ]);
    }
}
