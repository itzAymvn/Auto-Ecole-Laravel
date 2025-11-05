<?php

namespace App\Repositories\Eloquent;

use App\Enums\UserType;
use App\Models\User;
use App\Repositories\Contracts\UserRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

/**
 * User Repository
 */
class UserRepository extends BaseRepository implements UserRepositoryInterface
{
    /**
     * UserRepository constructor.
     *
     * @param User $model
     */
    public function __construct(User $model)
    {
        parent::__construct($model);
    }

    /**
     * {@inheritDoc}
     */
    public function getUsersByType(UserType $type, array $columns = ['*']): Collection
    {
        return $this->model->where('type', $type->value)->get($columns);
    }

    /**
     * {@inheritDoc}
     */
    public function getPaginatedWithFilters(int $perPage, array $filters = []): LengthAwarePaginator
    {
        $query = $this->model->query();

        if (isset($filters['type'])) {
            $query->where('type', $filters['type']);
        }

        if (isset($filters['name'])) {
            $query->where('name', 'like', "%{$filters['name']}%");
        }

        if (isset($filters['email'])) {
            $query->where('email', 'like', "%{$filters['email']}%");
        }

        return $query->paginate($perPage);
    }

    /**
     * {@inheritDoc}
     */
    public function findByEmail(string $email): ?Model
    {
        return $this->findBy('email', $email);
    }
}
