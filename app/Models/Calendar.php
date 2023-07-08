<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Calendar extends Model
{
    use HasFactory;

    //Relations with other models
    public function routeDates()
    {
        return $this->hasMany(RoutesData::class);
    }

    public function daysDisabled()
    {
        return $this->hasMany(CalendarDaysDisabled::class);
    }
}
