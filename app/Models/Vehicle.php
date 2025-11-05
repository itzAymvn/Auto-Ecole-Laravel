<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Vehicle Model
 *
 * @property int $id
 * @property string $matricule
 * @property string $model
 * @property string|null $image
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 */
class Vehicle extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'matricule',
        'model',
        'image',
    ];

    /**
     * Get the exams for the vehicle.
     *
     * @return HasMany
     */
    public function exam(): HasMany
    {
        return $this->hasMany(Exam::class);
    }

    /**
     * Get the sessions for the vehicle.
     *
     * @return HasMany
     */
    public function session(): HasMany
    {
        return $this->hasMany(Session::class);
    }
}
