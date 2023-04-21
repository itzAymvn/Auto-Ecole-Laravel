<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsToMany(User::class)->withTimestamps()->withPivot('result');
    }
    
}
