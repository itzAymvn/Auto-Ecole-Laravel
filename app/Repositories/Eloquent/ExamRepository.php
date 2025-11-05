<?php

namespace App\Repositories\Eloquent;

use App\Enums\ExamType;
use App\Models\Exam;
use App\Repositories\Contracts\ExamRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

/**
 * Exam Repository
 */
class ExamRepository extends BaseRepository implements ExamRepositoryInterface
{
    /**
     * ExamRepository constructor.
     *
     * @param Exam $model
     */
    public function __construct(Exam $model)
    {
        parent::__construct($model);
    }

    /**
     * {@inheritDoc}
     */
    public function getPaginatedWithRelations(int $perPage): LengthAwarePaginator
    {
        return $this->model
            ->with(['instructor', 'vehicle', 'user'])
            ->withCount('user')
            ->orderBy('exam_date', 'desc')
            ->paginate($perPage);
    }

    /**
     * {@inheritDoc}
     */
    public function getByType(ExamType $type): Collection
    {
        return $this->model
            ->where('exam_type', $type->value)
            ->with(['instructor', 'vehicle'])
            ->get();
    }

    /**
     * {@inheritDoc}
     */
    public function getByDate(string $date): Collection
    {
        return $this->model
            ->where('exam_date', $date)
            ->with(['instructor', 'vehicle'])
            ->get();
    }

    /**
     * {@inheritDoc}
     */
    public function attachStudents(int $examId, array $studentIds): void
    {
        $exam = $this->findOrFail($examId);
        $exam->user()->attach($studentIds);
    }

    /**
     * {@inheritDoc}
     */
    public function detachStudents(int $examId, array $studentIds): void
    {
        $exam = $this->findOrFail($examId);
        $exam->user()->detach($studentIds);
    }

    /**
     * {@inheritDoc}
     */
    public function updateStudentResult(int $examId, int $studentId, bool $result): void
    {
        $exam = $this->findOrFail($examId);
        $exam->user()->updateExistingPivot($studentId, ['result' => $result]);
    }
}
