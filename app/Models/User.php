<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;

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
        return $this->belongsToMany(Exam::class);
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
