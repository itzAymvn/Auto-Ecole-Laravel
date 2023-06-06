<?php

namespace App\Models;

use App\Models\Vehicle;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Session extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsToMany(User::class)->withTimestamps()->withPivot('attended');
    }

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }
}
