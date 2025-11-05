<?php

namespace App\Repositories\Eloquent;

use App\Models\Payment;
use App\Repositories\Contracts\PaymentRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

/**
 * Payment Repository
 */
class PaymentRepository extends BaseRepository implements PaymentRepositoryInterface
{
    /**
     * PaymentRepository constructor.
     *
     * @param Payment $model
     */
    public function __construct(Payment $model)
    {
        parent::__construct($model);
    }

    /**
     * {@inheritDoc}
     */
    public function getPaginatedWithStudent(int $perPage): LengthAwarePaginator
    {
        return $this->model
            ->with('student')
            ->orderBy('created_at', 'desc')
            ->paginate($perPage);
    }

    /**
     * {@inheritDoc}
     */
    public function getByStudent(int $studentId): Collection
    {
        return $this->model
            ->where('student_id', $studentId)
            ->orderBy('created_at', 'desc')
            ->get();
    }

    /**
     * {@inheritDoc}
     */
    public function getWithRemainingBalance(): Collection
    {
        return $this->model
            ->where('remaining_amount', '>', 0)
            ->with('student')
            ->get();
    }

    /**
     * {@inheritDoc}
     */
    public function getFullyPaid(): Collection
    {
        return $this->model
            ->where('remaining_amount', '<=', 0)
            ->with('student')
            ->get();
    }

    /**
     * {@inheritDoc}
     */
    public function calculateTotalRevenue(): float
    {
        return (float) $this->model->sum('amount_paid');
    }

    /**
     * {@inheritDoc}
     */
    public function calculateTotalOutstanding(): float
    {
        return (float) $this->model->sum('remaining_amount');
    }
}
