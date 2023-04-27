<?php

namespace App\Models;

use App\Models\User;
use App\Models\Vehicle;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Exam extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsToMany(User::class)->withTimestamps()->withPivot('result');
    }

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }
}
