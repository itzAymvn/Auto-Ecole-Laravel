<?php

namespace App\Services;

use App\Repositories\Contracts\VehicleRepositoryInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

/**
 * Vehicle Service
 *
 * Handles vehicle-related business logic.
 */
class VehicleService
{
    /**
     * @param VehicleRepositoryInterface $vehicleRepository
     * @param FileUploadService $fileUploadService
     */
    public function __construct(
        protected VehicleRepositoryInterface $vehicleRepository,
        protected FileUploadService $fileUploadService
    ) {
    }

    /**
     * Get paginated vehicles
     *
     * @param int $perPage
     * @return LengthAwarePaginator
     */
    public function getPaginatedVehicles(int $perPage = 15): LengthAwarePaginator
    {
        return $this->vehicleRepository->getPaginatedWithExamsCount($perPage);
    }

    /**
     * Create a new vehicle
     *
     * @param array<string, mixed> $data
     * @return Model
     */
    public function createVehicle(array $data): Model
    {
        if (isset($data['image'])) {
            $data['image'] = $this->fileUploadService->upload($data['image'], 'vehicles');
        }

        return $this->vehicleRepository->create($data);
    }

    /**
     * Update a vehicle
     *
     * @param int $id
     * @param array<string, mixed> $data
     * @return bool
     */
    public function updateVehicle(int $id, array $data): bool
    {
        $vehicle = $this->vehicleRepository->findOrFail($id);

        if (isset($data['image'])) {
            $data['image'] = $this->fileUploadService->update(
                $data['image'],
                $vehicle->image,
                'vehicles'
            );
        }

        return $this->vehicleRepository->update($id, $data);
    }

    /**
     * Delete a vehicle
     *
     * @param int $id
     * @return bool
     */
    public function deleteVehicle(int $id): bool
    {
        $vehicle = $this->vehicleRepository->findOrFail($id);

        if ($vehicle->image) {
            $this->fileUploadService->delete($vehicle->image, 'vehicles');
        }

        return $this->vehicleRepository->delete($id);
    }

    /**
     * Find vehicle by ID
     *
     * @param int $id
     * @return Model
     */
    public function findVehicle(int $id): Model
    {
        return $this->vehicleRepository->findOrFail($id);
    }
}
