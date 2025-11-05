<?php

namespace App\Repositories\Contracts;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

/**
 * Payment Repository Interface
 */
interface PaymentRepositoryInterface extends BaseRepositoryInterface
{
    /**
     * Get paginated payments with student
     *
     * @param int $perPage
     * @return LengthAwarePaginator
     */
    public function getPaginatedWithStudent(int $perPage): LengthAwarePaginator;

    /**
     * Get payments by student
     *
     * @param int $studentId
     * @return Collection
     */
    public function getByStudent(int $studentId): Collection;

    /**
     * Get payments with remaining balance
     *
     * @return Collection
     */
    public function getWithRemainingBalance(): Collection;

    /**
     * Get fully paid payments
     *
     * @return Collection
     */
    public function getFullyPaid(): Collection;

    /**
     * Calculate total revenue
     *
     * @return float
     */
    public function calculateTotalRevenue(): float;

    /**
     * Calculate total outstanding
     *
     * @return float
     */
    public function calculateTotalOutstanding(): float;
}
