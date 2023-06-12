<?php

namespace App\Models;

use Illuminate\Auth\Notifications\ResetPassword as ResetPasswordNotification;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\Auth\CanResetPassword;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Auth\Authenticatable as AuthenticableTrait;



class User extends Model implements Authenticatable, CanResetPassword
{
    use HasFactory;
    use AuthenticableTrait;
    use Notifiable;


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
    public function getEmailForPasswordReset()
    {
        return $this->email;
    }

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPasswordNotification($token));
    }
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
