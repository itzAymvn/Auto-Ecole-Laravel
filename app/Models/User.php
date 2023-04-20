<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Auth\Authenticatable as AuthenticableTrait;

class User extends Model implements Authenticatable
{
    use HasFactory;
    use AuthenticableTrait;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'address',
        'birthdate',
        'password',
        'type',
        'image',
    ];

    public function vehicles()
    {
        return $this->hasMany(Vehicle::class);
    }

    public function exams()
    {
        return $this->belongsToMany(Exam::class)->withTimestamps();
    }

    public function sessions()
    {
        return $this->hasMany(Session::class);
    }

    public function spendings()
    {
        return $this->hasMany(Spending::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }
}
