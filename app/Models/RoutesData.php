<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoutesData extends Model
{
    use HasFactory;

    //Relations with other models
    public function route()
    {
        return $this->belongsTo(Route::class);
    }

    public function calendar()
    {
        return $this->belongsTo(Calendar::class, 'calendar_id');
    }
}
