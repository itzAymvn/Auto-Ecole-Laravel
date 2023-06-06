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

    // A user can have many vehicles (which means he can have many exams and sessions)
    public function vehicles()
    {
        return $this->hasMany(Vehicle::class);
    }

    // A user can have many exams
    public function exams()
    {
        return $this->belongsToMany(Exam::class)->withTimestamps();
    }

    // A user can have many sessions
    public function sessions()
    {
        return $this->belongsToMany(Session::class)->withTimestamps();
    }

    // A user (who isn't a student) can have many spendings (getting paid by the school)
    public function spendings()
    {
        return $this->hasMany(Spending::class);
    }

    // A user (who is a student) can have many payments (paying the school)
    public function payments()
    {
        return $this->hasMany(Payment::class, 'student_id');
    }
}
