<?php

namespace Tests\Unit\Services;

use App\Services\FileUploadService;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class FileUploadServiceTest extends TestCase
{
    protected FileUploadService $service;

    protected function setUp(): void
    {
        parent::setUp();
        $this->service = new FileUploadService;
        Storage::fake('public');
    }

    public function test_can_upload_file(): void
    {
        $file = UploadedFile::fake()->image('test.jpg');

        $path = $this->service->upload($file, 'test');

        Storage::disk('public')->assertExists($path);
        $this->assertStringContainsString('test/', $path);
    }

    public function test_can_delete_file(): void
    {
        $file = UploadedFile::fake()->image('test.jpg');
        $path = $this->service->upload($file, 'test');

        Storage::disk('public')->assertExists($path);

        $result = $this->service->delete($path);

        $this->assertTrue($result);
        Storage::disk('public')->assertMissing($path);
    }

    public function test_delete_returns_false_for_non_existent_file(): void
    {
        $result = $this->service->delete('non-existent.jpg');

        $this->assertFalse($result);
    }

    public function test_can_update_file(): void
    {
        $oldFile = UploadedFile::fake()->image('old.jpg');
        $oldPath = $this->service->upload($oldFile, 'test');

        $newFile = UploadedFile::fake()->image('new.jpg');
        $newPath = $this->service->update($newFile, $oldPath, 'test');

        Storage::disk('public')->assertMissing($oldPath);
        Storage::disk('public')->assertExists($newPath);
    }
}
