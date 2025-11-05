<?php

namespace App\Repositories\Eloquent;

use App\Repositories\Contracts\BaseRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

/**
 * Base Repository
 *
 * Abstract base class for all repositories providing common database operations.
 */
abstract class BaseRepository implements BaseRepositoryInterface
{
    /**
     * @var Model
     */
    protected Model $model;

    /**
     * BaseRepository constructor.
     *
     * @param Model $model
     */
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * {@inheritDoc}
     */
    public function all(array $columns = ['*'], array $relations = []): Collection
    {
        return $this->model->with($relations)->get($columns);
    }

    /**
     * {@inheritDoc}
     */
    public function paginate(int $perPage = 15, array $columns = ['*'], array $relations = []): LengthAwarePaginator
    {
        return $this->model->with($relations)->paginate($perPage, $columns);
    }

    /**
     * {@inheritDoc}
     */
    public function find(int $id, array $columns = ['*'], array $relations = []): ?Model
    {
        return $this->model->with($relations)->find($id, $columns);
    }

    /**
     * {@inheritDoc}
     */
    public function findOrFail(int $id, array $columns = ['*'], array $relations = []): Model
    {
        return $this->model->with($relations)->findOrFail($id, $columns);
    }

    /**
     * {@inheritDoc}
     */
    public function findBy(string $attribute, mixed $value, array $columns = ['*'], array $relations = []): ?Model
    {
        return $this->model->with($relations)->where($attribute, $value)->first($columns);
    }

    /**
     * {@inheritDoc}
     */
    public function getBy(string $attribute, mixed $value, array $columns = ['*'], array $relations = []): Collection
    {
        return $this->model->with($relations)->where($attribute, $value)->get($columns);
    }

    /**
     * {@inheritDoc}
     */
    public function create(array $data): Model
    {
        return $this->model->create($data);
    }

    /**
     * {@inheritDoc}
     */
    public function update(int $id, array $data): bool
    {
        $record = $this->findOrFail($id);

        return $record->update($data);
    }

    /**
     * {@inheritDoc}
     */
    public function delete(int $id): bool
    {
        $record = $this->findOrFail($id);

        return $record->delete();
    }

    /**
     * {@inheritDoc}
     */
    public function count(array $criteria = []): int
    {
        $query = $this->model->query();

        foreach ($criteria as $key => $value) {
            $query->where($key, $value);
        }

        return $query->count();
    }
}
