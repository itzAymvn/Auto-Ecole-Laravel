<?php

namespace App\Repositories\Contracts;

use App\Enums\UserType;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

/**
 * User Repository Interface
 */
interface UserRepositoryInterface extends BaseRepositoryInterface
{
    /**
     * Get users by type
     *
     * @param UserType $type
     * @param array<string> $columns
     * @return Collection
     */
    public function getUsersByType(UserType $type, array $columns = ['*']): Collection;

    /**
     * Get paginated users with filters
     *
     * @param int $perPage
     * @param array<string, mixed> $filters
     * @return LengthAwarePaginator
     */
    public function getPaginatedWithFilters(int $perPage, array $filters = []): LengthAwarePaginator;

    /**
     * Find user by email
     *
     * @param string $email
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function findByEmail(string $email): ?\Illuminate\Database\Eloquent\Model;
}
