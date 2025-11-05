<?php

namespace App\Services;

use App\Repositories\Contracts\SessionRepositoryInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

/**
 * Session Service
 *
 * Handles session-related business logic.
 */
class SessionService
{
    /**
     * @param SessionRepositoryInterface $sessionRepository
     */
    public function __construct(
        protected SessionRepositoryInterface $sessionRepository
    ) {
    }

    /**
     * Get paginated sessions with relations
     *
     * @param int $perPage
     * @return LengthAwarePaginator
     */
    public function getPaginatedSessions(int $perPage = 15): LengthAwarePaginator
    {
        return $this->sessionRepository->getPaginatedWithRelations($perPage);
    }

    /**
     * Create a new session
     *
     * @param array<string, mixed> $data
     * @return Model
     */
    public function createSession(array $data): Model
    {
        return $this->sessionRepository->create($data);
    }

    /**
     * Update a session
     *
     * @param int $id
     * @param array<string, mixed> $data
     * @return bool
     */
    public function updateSession(int $id, array $data): bool
    {
        return $this->sessionRepository->update($id, $data);
    }

    /**
     * Delete a session
     *
     * @param int $id
     * @return bool
     */
    public function deleteSession(int $id): bool
    {
        return $this->sessionRepository->delete($id);
    }

    /**
     * Add students to session
     *
     * @param int $sessionId
     * @param array<int> $studentIds
     * @return void
     */
    public function addStudentsToSession(int $sessionId, array $studentIds): void
    {
        $this->sessionRepository->attachStudents($sessionId, $studentIds);
    }

    /**
     * Remove students from session
     *
     * @param int $sessionId
     * @param array<int> $studentIds
     * @return void
     */
    public function removeStudentsFromSession(int $sessionId, array $studentIds): void
    {
        $this->sessionRepository->detachStudents($sessionId, $studentIds);
    }

    /**
     * Update student attendance
     *
     * @param int $sessionId
     * @param int $studentId
     * @param bool $attended
     * @return void
     */
    public function updateStudentAttendance(int $sessionId, int $studentId, bool $attended): void
    {
        $this->sessionRepository->updateStudentAttendance($sessionId, $studentId, $attended);
    }

    /**
     * Find session by ID
     *
     * @param int $id
     * @return Model
     */
    public function findSession(int $id): Model
    {
        return $this->sessionRepository->findOrFail($id, ['*'], ['instructor', 'user']);
    }
}
