<?php

namespace App\Repositories\Contracts;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

/**
 * Session Repository Interface
 */
interface SessionRepositoryInterface extends BaseRepositoryInterface
{
    /**
     * Get sessions with instructor and students
     *
     * @param int $perPage
     * @return LengthAwarePaginator
     */
    public function getPaginatedWithRelations(int $perPage): LengthAwarePaginator;

    /**
     * Get sessions by date
     *
     * @param string $date
     * @return Collection
     */
    public function getByDate(string $date): Collection;

    /**
     * Get completed sessions
     *
     * @return Collection
     */
    public function getCompleted(): Collection;

    /**
     * Get pending sessions
     *
     * @return Collection
     */
    public function getPending(): Collection;

    /**
     * Attach students to session
     *
     * @param int $sessionId
     * @param array<int> $studentIds
     * @return void
     */
    public function attachStudents(int $sessionId, array $studentIds): void;

    /**
     * Detach students from session
     *
     * @param int $sessionId
     * @param array<int> $studentIds
     * @return void
     */
    public function detachStudents(int $sessionId, array $studentIds): void;

    /**
     * Update student attendance
     *
     * @param int $sessionId
     * @param int $studentId
     * @param bool $attended
     * @return void
     */
    public function updateStudentAttendance(int $sessionId, int $studentId, bool $attended): void;
}
