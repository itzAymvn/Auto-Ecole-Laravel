<?php

namespace App\Repositories\Eloquent;

use App\Models\Session;
use App\Repositories\Contracts\SessionRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

/**
 * Session Repository
 */
class SessionRepository extends BaseRepository implements SessionRepositoryInterface
{
    /**
     * SessionRepository constructor.
     *
     * @param Session $model
     */
    public function __construct(Session $model)
    {
        parent::__construct($model);
    }

    /**
     * {@inheritDoc}
     */
    public function getPaginatedWithRelations(int $perPage): LengthAwarePaginator
    {
        return $this->model
            ->with(['instructor', 'user'])
            ->withCount('user')
            ->orderBy('session_date', 'desc')
            ->paginate($perPage);
    }

    /**
     * {@inheritDoc}
     */
    public function getByDate(string $date): Collection
    {
        return $this->model
            ->where('session_date', $date)
            ->with(['instructor', 'user'])
            ->get();
    }

    /**
     * {@inheritDoc}
     */
    public function getCompleted(): Collection
    {
        return $this->model
            ->where('is_completed', true)
            ->with(['instructor', 'user'])
            ->get();
    }

    /**
     * {@inheritDoc}
     */
    public function getPending(): Collection
    {
        return $this->model
            ->where('is_completed', false)
            ->with(['instructor', 'user'])
            ->get();
    }

    /**
     * {@inheritDoc}
     */
    public function attachStudents(int $sessionId, array $studentIds): void
    {
        $session = $this->findOrFail($sessionId);
        $session->user()->attach($studentIds);
    }

    /**
     * {@inheritDoc}
     */
    public function detachStudents(int $sessionId, array $studentIds): void
    {
        $session = $this->findOrFail($sessionId);
        $session->user()->detach($studentIds);
    }

    /**
     * {@inheritDoc}
     */
    public function updateStudentAttendance(int $sessionId, int $studentId, bool $attended): void
    {
        $session = $this->findOrFail($sessionId);
        $session->user()->updateExistingPivot($studentId, ['attended' => $attended]);
    }
}
