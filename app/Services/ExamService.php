<?php

namespace App\Services;

use App\Enums\ExamType;
use App\Repositories\Contracts\ExamRepositoryInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

/**
 * Exam Service
 *
 * Handles exam-related business logic.
 */
class ExamService
{
    /**
     * @param ExamRepositoryInterface $examRepository
     */
    public function __construct(
        protected ExamRepositoryInterface $examRepository
    ) {
    }

    /**
     * Get paginated exams with relations
     *
     * @param int $perPage
     * @return LengthAwarePaginator
     */
    public function getPaginatedExams(int $perPage = 15): LengthAwarePaginator
    {
        return $this->examRepository->getPaginatedWithRelations($perPage);
    }

    /**
     * Create a new exam
     *
     * @param array<string, mixed> $data
     * @return Model
     */
    public function createExam(array $data): Model
    {
        return $this->examRepository->create($data);
    }

    /**
     * Update an exam
     *
     * @param int $id
     * @param array<string, mixed> $data
     * @return bool
     */
    public function updateExam(int $id, array $data): bool
    {
        return $this->examRepository->update($id, $data);
    }

    /**
     * Delete an exam
     *
     * @param int $id
     * @return bool
     */
    public function deleteExam(int $id): bool
    {
        return $this->examRepository->delete($id);
    }

    /**
     * Add students to exam
     *
     * @param int $examId
     * @param array<int> $studentIds
     * @return void
     */
    public function addStudentsToExam(int $examId, array $studentIds): void
    {
        $this->examRepository->attachStudents($examId, $studentIds);
    }

    /**
     * Remove students from exam
     *
     * @param int $examId
     * @param array<int> $studentIds
     * @return void
     */
    public function removeStudentsFromExam(int $examId, array $studentIds): void
    {
        $this->examRepository->detachStudents($examId, $studentIds);
    }

    /**
     * Update student exam result
     *
     * @param int $examId
     * @param int $studentId
     * @param bool $result
     * @return void
     */
    public function updateStudentResult(int $examId, int $studentId, bool $result): void
    {
        $this->examRepository->updateStudentResult($examId, $studentId, $result);
    }

    /**
     * Find exam by ID
     *
     * @param int $id
     * @return Model
     */
    public function findExam(int $id): Model
    {
        return $this->examRepository->findOrFail($id, ['*'], ['instructor', 'vehicle', 'user']);
    }

    /**
     * Get exams by type
     *
     * @param ExamType $type
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getExamsByType(ExamType $type): \Illuminate\Database\Eloquent\Collection
    {
        return $this->examRepository->getByType($type);
    }
}
