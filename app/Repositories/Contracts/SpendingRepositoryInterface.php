<?php

namespace App\Repositories\Contracts;

use App\Enums\SpendingType;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

/**
 * Spending Repository Interface
 */
interface SpendingRepositoryInterface extends BaseRepositoryInterface
{
    /**
     * Get paginated spendings with user
     *
     * @param int $perPage
     * @return LengthAwarePaginator
     */
    public function getPaginatedWithUser(int $perPage): LengthAwarePaginator;

    /**
     * Get spendings by type
     *
     * @param SpendingType $type
     * @return Collection
     */
    public function getByType(SpendingType $type): Collection;

    /**
     * Get spendings by user
     *
     * @param int $userId
     * @return Collection
     */
    public function getByUser(int $userId): Collection;

    /**
     * Calculate total by type
     *
     * @param SpendingType $type
     * @return float
     */
    public function calculateTotalByType(SpendingType $type): float;

    /**
     * Calculate total expenses
     *
     * @return float
     */
    public function calculateTotalExpenses(): float;
}
