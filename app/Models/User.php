<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;

    /*
    * The user has many sessions.
    * student_id is the foreign key (in the sessions table).
    * id is the primary key (in the users table).

    */

    public function sessions()
    {
        return $this->hasMany(Session::class, 'student_id', 'id');
    }

    /*
    * The user has many exams.
    * student_id is the foreign key (in the exams table).
    * id is the primary key (in the users table).
    */

    public function exams()
    {
        return $this->hasMany(Exam::class, 'student_id', 'id');
    }

    /*
    * The user has many progress.
    * student_id is the foreign key (in the progress table).
    * id is the primary key (in the users table).
    */

    public function progress()
    {
        return $this->hasMany(Progress::class, 'student_id', 'id');
    }
}
