<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    use HasFactory;

    /*
    * The vehicle has many sessions.
    * vehicle_id is the foreign key (in the sessions table).
    * id is the primary key (in the vehicles table).
    */


    public function sessions()
    {
        return $this->hasMany(Session::class);
    }

    /*
    * The vehicle has many exams.
    * vehicle_id is the foreign key (in the exams table).
    * id is the primary key (in the vehicles table).
    */

    public function exams()
    {
        return $this->hasMany(Exam::class);
    }
}
