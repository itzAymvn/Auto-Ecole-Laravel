<?php

namespace App\Services;

use App\Enums\UserType;
use App\Repositories\Contracts\PaymentRepositoryInterface;
use App\Repositories\Contracts\SpendingRepositoryInterface;
use App\Repositories\Contracts\UserRepositoryInterface;

/**
 * Statistics Service
 *
 * Handles statistics and dashboard analytics.
 */
class StatisticsService
{
    /**
     * @param UserRepositoryInterface $userRepository
     * @param PaymentRepositoryInterface $paymentRepository
     * @param SpendingRepositoryInterface $spendingRepository
     */
    public function __construct(
        protected UserRepositoryInterface $userRepository,
        protected PaymentRepositoryInterface $paymentRepository,
        protected SpendingRepositoryInterface $spendingRepository
    ) {
    }

    /**
     * Get dashboard statistics
     *
     * @return array<string, mixed>
     */
    public function getDashboardStatistics(): array
    {
        return [
            'total_students' => $this->userRepository->count(['type' => UserType::STUDENT->value]),
            'total_instructors' => $this->userRepository->count(['type' => UserType::INSTRUCTOR->value]),
            'total_revenue' => $this->paymentRepository->calculateTotalRevenue(),
            'total_expenses' => $this->spendingRepository->calculateTotalExpenses(),
            'total_outstanding' => $this->paymentRepository->calculateTotalOutstanding(),
            'net_profit' => $this->calculateNetProfit(),
        ];
    }

    /**
     * Calculate net profit
     *
     * @return float
     */
    protected function calculateNetProfit(): float
    {
        $revenue = $this->paymentRepository->calculateTotalRevenue();
        $expenses = $this->spendingRepository->calculateTotalExpenses();

        return $revenue - $expenses;
    }
}
