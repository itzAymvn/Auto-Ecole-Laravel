<?php

namespace App\Services;

use App\Enums\UserType;
use App\Repositories\Contracts\UserRepositoryInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Hash;

/**
 * User Service
 *
 * Handles user-related business logic.
 */
class UserService
{
    /**
     * @param UserRepositoryInterface $userRepository
     * @param FileUploadService $fileUploadService
     */
    public function __construct(
        protected UserRepositoryInterface $userRepository,
        protected FileUploadService $fileUploadService
    ) {
    }

    /**
     * Get paginated users with filters
     *
     * @param int $perPage
     * @param array<string, mixed> $filters
     * @return LengthAwarePaginator
     */
    public function getPaginatedUsers(int $perPage = 15, array $filters = []): LengthAwarePaginator
    {
        return $this->userRepository->getPaginatedWithFilters($perPage, $filters);
    }

    /**
     * Create a new user
     *
     * @param array<string, mixed> $data
     * @return Model
     */
    public function createUser(array $data): Model
    {
        if (isset($data['image'])) {
            $data['image'] = $this->fileUploadService->upload($data['image'], 'users');
        }

        $data['password'] = Hash::make($data['password']);

        return $this->userRepository->create($data);
    }

    /**
     * Update a user
     *
     * @param int $id
     * @param array<string, mixed> $data
     * @return bool
     */
    public function updateUser(int $id, array $data): bool
    {
        $user = $this->userRepository->findOrFail($id);

        if (isset($data['image'])) {
            $data['image'] = $this->fileUploadService->update(
                $data['image'],
                $user->image,
                'users'
            );
        }

        if (isset($data['password']) && ! empty($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']);
        }

        return $this->userRepository->update($id, $data);
    }

    /**
     * Delete a user
     *
     * @param int $id
     * @return bool
     */
    public function deleteUser(int $id): bool
    {
        $user = $this->userRepository->findOrFail($id);

        if ($user->image) {
            $this->fileUploadService->delete($user->image, 'users');
        }

        return $this->userRepository->delete($id);
    }

    /**
     * Get users by type
     *
     * @param UserType $type
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getUsersByType(UserType $type): \Illuminate\Database\Eloquent\Collection
    {
        return $this->userRepository->getUsersByType($type);
    }

    /**
     * Find user by ID
     *
     * @param int $id
     * @return Model
     */
    public function findUser(int $id): Model
    {
        return $this->userRepository->findOrFail($id);
    }
}
