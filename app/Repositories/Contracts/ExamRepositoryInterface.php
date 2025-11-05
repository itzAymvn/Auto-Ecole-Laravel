<?php

namespace App\Repositories\Contracts;

use App\Enums\ExamType;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

/**
 * Exam Repository Interface
 */
interface ExamRepositoryInterface extends BaseRepositoryInterface
{
    /**
     * Get exams with instructor and students
     *
     * @param int $perPage
     * @return LengthAwarePaginator
     */
    public function getPaginatedWithRelations(int $perPage): LengthAwarePaginator;

    /**
     * Get exams by type
     *
     * @param ExamType $type
     * @return Collection
     */
    public function getByType(ExamType $type): Collection;

    /**
     * Get exams by date
     *
     * @param string $date
     * @return Collection
     */
    public function getByDate(string $date): Collection;

    /**
     * Attach students to exam
     *
     * @param int $examId
     * @param array<int> $studentIds
     * @return void
     */
    public function attachStudents(int $examId, array $studentIds): void;

    /**
     * Detach students from exam
     *
     * @param int $examId
     * @param array<int> $studentIds
     * @return void
     */
    public function detachStudents(int $examId, array $studentIds): void;

    /**
     * Update student result
     *
     * @param int $examId
     * @param int $studentId
     * @param bool $result
     * @return void
     */
    public function updateStudentResult(int $examId, int $studentId, bool $result): void;
}
