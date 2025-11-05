<?php

namespace App\Repositories\Contracts;

use Illuminate\Pagination\LengthAwarePaginator;

/**
 * Vehicle Repository Interface
 */
interface VehicleRepositoryInterface extends BaseRepositoryInterface
{
    /**
     * Get paginated vehicles with exams count
     *
     * @param int $perPage
     * @return LengthAwarePaginator
     */
    public function getPaginatedWithExamsCount(int $perPage): LengthAwarePaginator;

    /**
     * Find vehicle by matricule
     *
     * @param string $matricule
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function findByMatricule(string $matricule): ?\Illuminate\Database\Eloquent\Model;
}
