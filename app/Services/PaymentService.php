<?php

namespace App\Services;

use App\Repositories\Contracts\PaymentRepositoryInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

/**
 * Payment Service
 *
 * Handles payment-related business logic.
 */
class PaymentService
{
    /**
     * @param PaymentRepositoryInterface $paymentRepository
     */
    public function __construct(
        protected PaymentRepositoryInterface $paymentRepository
    ) {
    }

    /**
     * Get paginated payments
     *
     * @param int $perPage
     * @return LengthAwarePaginator
     */
    public function getPaginatedPayments(int $perPage = 15): LengthAwarePaginator
    {
        return $this->paymentRepository->getPaginatedWithStudent($perPage);
    }

    /**
     * Create a new payment
     *
     * @param array<string, mixed> $data
     * @return Model
     */
    public function createPayment(array $data): Model
    {
        $data['remaining_amount'] = $data['goal_amount'] - $data['amount_paid'];

        return $this->paymentRepository->create($data);
    }

    /**
     * Update a payment
     *
     * @param int $id
     * @param array<string, mixed> $data
     * @return bool
     */
    public function updatePayment(int $id, array $data): bool
    {
        $data['remaining_amount'] = $data['goal_amount'] - $data['amount_paid'];

        return $this->paymentRepository->update($id, $data);
    }

    /**
     * Delete a payment
     *
     * @param int $id
     * @return bool
     */
    public function deletePayment(int $id): bool
    {
        return $this->paymentRepository->delete($id);
    }

    /**
     * Find payment by ID
     *
     * @param int $id
     * @return Model
     */
    public function findPayment(int $id): Model
    {
        return $this->paymentRepository->findOrFail($id, ['*'], ['student']);
    }

    /**
     * Get payments with remaining balance
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getPaymentsWithBalance(): \Illuminate\Database\Eloquent\Collection
    {
        return $this->paymentRepository->getWithRemainingBalance();
    }

    /**
     * Calculate total revenue
     *
     * @return float
     */
    public function getTotalRevenue(): float
    {
        return $this->paymentRepository->calculateTotalRevenue();
    }

    /**
     * Calculate total outstanding
     *
     * @return float
     */
    public function getTotalOutstanding(): float
    {
        return $this->paymentRepository->calculateTotalOutstanding();
    }
}
