<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CalendarDaysDisabled extends Model
{
    use HasFactory;

    /**
     * Obtiene los días deshabilitados asociados al calendario.
     *
     * @return object Objeto JSON con los días deshabilitados en formato 'Y-m-d'
     */
    public static function getDaysDisabled($calendar_id)
    {
        $daysDisabled = CalendarDaysDisabled::where('calendar_id', $calendar_id)->get('day')->map(function ($day) {
            return Carbon::parse($day['day'])->format('Y-m-d');
        });

        return $daysDisabled;
    }

    public function calendar()
    {
        return $this->belongsTo(Calendar::class);
    }
}
