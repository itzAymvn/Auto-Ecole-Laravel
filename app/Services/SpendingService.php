<?php

namespace App\Services;

use App\Enums\SpendingType;
use App\Repositories\Contracts\SpendingRepositoryInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

/**
 * Spending Service
 *
 * Handles spending-related business logic.
 */
class SpendingService
{
    /**
     * @param SpendingRepositoryInterface $spendingRepository
     */
    public function __construct(
        protected SpendingRepositoryInterface $spendingRepository
    ) {
    }

    /**
     * Get paginated spendings
     *
     * @param int $perPage
     * @return LengthAwarePaginator
     */
    public function getPaginatedSpendings(int $perPage = 15): LengthAwarePaginator
    {
        return $this->spendingRepository->getPaginatedWithUser($perPage);
    }

    /**
     * Create a new spending
     *
     * @param array<string, mixed> $data
     * @return Model
     */
    public function createSpending(array $data): Model
    {
        return $this->spendingRepository->create($data);
    }

    /**
     * Update a spending
     *
     * @param int $id
     * @param array<string, mixed> $data
     * @return bool
     */
    public function updateSpending(int $id, array $data): bool
    {
        return $this->spendingRepository->update($id, $data);
    }

    /**
     * Delete a spending
     *
     * @param int $id
     * @return bool
     */
    public function deleteSpending(int $id): bool
    {
        return $this->spendingRepository->delete($id);
    }

    /**
     * Find spending by ID
     *
     * @param int $id
     * @return Model
     */
    public function findSpending(int $id): Model
    {
        return $this->spendingRepository->findOrFail($id, ['*'], ['user']);
    }

    /**
     * Get spendings by type
     *
     * @param SpendingType $type
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getSpendingsByType(SpendingType $type): \Illuminate\Database\Eloquent\Collection
    {
        return $this->spendingRepository->getByType($type);
    }

    /**
     * Calculate total expenses
     *
     * @return float
     */
    public function getTotalExpenses(): float
    {
        return $this->spendingRepository->calculateTotalExpenses();
    }

    /**
     * Calculate salary expenses
     *
     * @return float
     */
    public function getSalaryExpenses(): float
    {
        return $this->spendingRepository->calculateTotalByType(SpendingType::SALARY);
    }
}
