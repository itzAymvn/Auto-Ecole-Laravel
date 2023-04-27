<?php

namespace App\Models;

use App\Models\Exam;
use App\Models\Session;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Vehicle extends Model
{
    use HasFactory;

    public function exams()
    {
        return $this->hasMany(Exam::class);
    }

    public function sessions()
    {
        return $this->hasMany(Session::class);
    }
}
