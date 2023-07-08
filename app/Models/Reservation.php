<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    //Relations with other models
    public function userPlan()
    {
        return $this->belongsTo(UserPlan::class);
    }

    public function route()
    {
        return $this->belongsTo(Route::class);
    }
}
