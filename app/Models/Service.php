<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    //Relations with other models
    public function route()
    {
        return $this->belongsTo(Route::class, 'external_route_id', 'external_id');
    }
}
