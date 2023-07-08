<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CalendarDaysDisabled extends Model
{
    use HasFactory;

    //Relations with other models
    public function calendar()
    {
        return $this->belongsTo(Calendar::class);
    }
}
