<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * Session Model
 *
 * @property int $id
 * @property int $instructor_id
 * @property string $title
 * @property string $session_date
 * @property string $session_time
 * @property string $session_location
 * @property bool $is_completed
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 */
class Session extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'instructor_id',
        'title',
        'session_date',
        'session_time',
        'session_location',
        'is_completed',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'session_date' => 'date',
            'is_completed' => 'boolean',
        ];
    }

    /**
     * Get the students associated with the session.
     *
     * @return BelongsToMany
     */
    public function user(): BelongsToMany
    {
        return $this->belongsToMany(User::class)->withTimestamps()->withPivot('attended');
    }

    /**
     * Get the instructor for the session.
     *
     * @return BelongsTo
     */
    public function instructor(): BelongsTo
    {
        return $this->belongsTo(User::class, 'instructor_id');
    }
}
