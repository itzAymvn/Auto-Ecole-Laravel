<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    use HasFactory;

    /*
    * The exam belongs to an instructor.
    * instructor_id is the foreign key (in the exams table).
    * id is the primary key (in the users table).
    */

    public function instructor()
    {
        return $this->belongsTo(User::class, 'instructor_id', 'id');
    }

    /*
    * The exam belongs to a student.
    * student_id is the foreign key (in the exams table).
    * id is the primary key (in the users table).
    */

    public function student()
    {
        return $this->belongsTo(User::class, 'student_id', 'id');
    }

    /*
    * The exam belongs to a vehicle.
    * vehicle_id is the foreign key (in the exams table).
    * id is the primary key (in the vehicles table).
    */

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }
}
