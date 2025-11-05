<?php

namespace App\Repositories\Contracts;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

/**
 * Base Repository Interface
 *
 * Defines common repository operations for all entities.
 */
interface BaseRepositoryInterface
{
    /**
     * Get all records
     *
     * @param array<string> $columns
     * @param array<string> $relations
     * @return Collection
     */
    public function all(array $columns = ['*'], array $relations = []): Collection;

    /**
     * Get paginated records
     *
     * @param int $perPage
     * @param array<string> $columns
     * @param array<string> $relations
     * @return LengthAwarePaginator
     */
    public function paginate(int $perPage = 15, array $columns = ['*'], array $relations = []): LengthAwarePaginator;

    /**
     * Find record by ID
     *
     * @param int $id
     * @param array<string> $columns
     * @param array<string> $relations
     * @return Model|null
     */
    public function find(int $id, array $columns = ['*'], array $relations = []): ?Model;

    /**
     * Find record by ID or fail
     *
     * @param int $id
     * @param array<string> $columns
     * @param array<string> $relations
     * @return Model
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
     */
    public function findOrFail(int $id, array $columns = ['*'], array $relations = []): Model;

    /**
     * Find record by attribute
     *
     * @param string $attribute
     * @param mixed $value
     * @param array<string> $columns
     * @param array<string> $relations
     * @return Model|null
     */
    public function findBy(string $attribute, mixed $value, array $columns = ['*'], array $relations = []): ?Model;

    /**
     * Get records by attribute
     *
     * @param string $attribute
     * @param mixed $value
     * @param array<string> $columns
     * @param array<string> $relations
     * @return Collection
     */
    public function getBy(string $attribute, mixed $value, array $columns = ['*'], array $relations = []): Collection;

    /**
     * Create a new record
     *
     * @param array<string, mixed> $data
     * @return Model
     */
    public function create(array $data): Model;

    /**
     * Update a record
     *
     * @param int $id
     * @param array<string, mixed> $data
     * @return bool
     */
    public function update(int $id, array $data): bool;

    /**
     * Delete a record
     *
     * @param int $id
     * @return bool
     */
    public function delete(int $id): bool;

    /**
     * Count records
     *
     * @param array<string, mixed> $criteria
     * @return int
     */
    public function count(array $criteria = []): int;
}
