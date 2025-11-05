<?php

namespace App\Repositories\Eloquent;

use App\Models\Vehicle;
use App\Repositories\Contracts\VehicleRepositoryInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

/**
 * Vehicle Repository
 */
class VehicleRepository extends BaseRepository implements VehicleRepositoryInterface
{
    /**
     * VehicleRepository constructor.
     *
     * @param Vehicle $model
     */
    public function __construct(Vehicle $model)
    {
        parent::__construct($model);
    }

    /**
     * {@inheritDoc}
     */
    public function getPaginatedWithExamsCount(int $perPage): LengthAwarePaginator
    {
        return $this->model
            ->withCount('exam')
            ->paginate($perPage);
    }

    /**
     * {@inheritDoc}
     */
    public function findByMatricule(string $matricule): ?Model
    {
        return $this->findBy('matricule', $matricule);
    }
}
