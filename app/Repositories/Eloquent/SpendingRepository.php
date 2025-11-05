<?php

namespace App\Repositories\Eloquent;

use App\Enums\SpendingType;
use App\Models\Spending;
use App\Repositories\Contracts\SpendingRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

/**
 * Spending Repository
 */
class SpendingRepository extends BaseRepository implements SpendingRepositoryInterface
{
    /**
     * SpendingRepository constructor.
     *
     * @param Spending $model
     */
    public function __construct(Spending $model)
    {
        parent::__construct($model);
    }

    /**
     * {@inheritDoc}
     */
    public function getPaginatedWithUser(int $perPage): LengthAwarePaginator
    {
        return $this->model
            ->with('user')
            ->orderBy('created_at', 'desc')
            ->paginate($perPage);
    }

    /**
     * {@inheritDoc}
     */
    public function getByType(SpendingType $type): Collection
    {
        return $this->model
            ->where('type', $type->value)
            ->with('user')
            ->get();
    }

    /**
     * {@inheritDoc}
     */
    public function getByUser(int $userId): Collection
    {
        return $this->model
            ->where('user_id', $userId)
            ->orderBy('created_at', 'desc')
            ->get();
    }

    /**
     * {@inheritDoc}
     */
    public function calculateTotalByType(SpendingType $type): float
    {
        return (float) $this->model
            ->where('type', $type->value)
            ->sum('amount');
    }

    /**
     * {@inheritDoc}
     */
    public function calculateTotalExpenses(): float
    {
        return (float) $this->model->sum('amount');
    }
}
