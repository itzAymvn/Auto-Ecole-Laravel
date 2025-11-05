<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

/**
 * File Upload Service
 *
 * Handles file upload and deletion operations using Laravel's Storage facade.
 */
class FileUploadService
{
    /**
     * Upload a file to storage
     *
     * @param UploadedFile $file
     * @param string $directory
     * @param string $disk
     * @return string The stored file path
     */
    public function upload(UploadedFile $file, string $directory = 'images', string $disk = 'public'): string
    {
        $filename = Str::uuid().'.'.$file->getClientOriginalExtension();

        return $file->storeAs($directory, $filename, $disk);
    }

    /**
     * Delete a file from storage
     *
     * @param string|null $path
     * @param string $disk
     * @return bool
     */
    public function delete(?string $path, string $disk = 'public'): bool
    {
        if (! $path || ! Storage::disk($disk)->exists($path)) {
            return false;
        }

        return Storage::disk($disk)->delete($path);
    }

    /**
     * Update a file (delete old and upload new)
     *
     * @param UploadedFile $newFile
     * @param string|null $oldPath
     * @param string $directory
     * @param string $disk
     * @return string The new file path
     */
    public function update(UploadedFile $newFile, ?string $oldPath, string $directory = 'images', string $disk = 'public'): string
    {
        $this->delete($oldPath, $disk);

        return $this->upload($newFile, $directory, $disk);
    }
}
