<?php

namespace App\Models;

use App\Enums\ExamType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * Exam Model
 *
 * @property int $id
 * @property int $instructor_id
 * @property int|null $vehicle_id
 * @property ExamType $exam_type
 * @property string $exam_title
 * @property string $exam_date
 * @property string $exam_time
 * @property string $exam_location
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 */
class Exam extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'instructor_id',
        'vehicle_id',
        'exam_type',
        'exam_title',
        'exam_date',
        'exam_time',
        'exam_location',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'exam_type' => ExamType::class,
            'exam_date' => 'date',
        ];
    }

    /**
     * Get the students associated with the exam.
     *
     * @return BelongsToMany
     */
    public function user(): BelongsToMany
    {
        return $this->belongsToMany(User::class)->withTimestamps()->withPivot('result');
    }

    /**
     * Get the instructor for the exam.
     *
     * @return BelongsTo
     */
    public function instructor(): BelongsTo
    {
        return $this->belongsTo(User::class, 'instructor_id');
    }

    /**
     * Get the vehicle for the exam.
     *
     * @return BelongsTo
     */
    public function vehicle(): BelongsTo
    {
        return $this->belongsTo(Vehicle::class);
    }
}
