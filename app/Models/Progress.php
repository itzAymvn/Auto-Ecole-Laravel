<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Progress extends Model
{
    use HasFactory;

    /*
    * The progress belongs to an student.
    * student_id is the foreign key (in the progress table).
    * id is the primary key (in the users table).
    */


    public function student()
    {
        return $this->belongsTo(User::class);
    }
}
