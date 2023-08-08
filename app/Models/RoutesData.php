<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoutesData extends Model
{
    use HasFactory;

    /**
     * Obtiene el rango de fechas inicial y final asociado a la ruta.
     *
     * @return array Arreglo con las fechas de inicio y fin en formato 'Y-m-d'
     */
    public static function getRange($route_id)
    {

        $range = RoutesData::where('route_id', $route_id)->first(['date_init', 'date_finish']);

        $responseData = [
            'date_init' => Carbon::parse($range['date_init'])->format('Y-m-d'),
            'date_finish' => Carbon::parse($range['date_finish'])->format('Y-m-d'),
        ];

        return $responseData;
    }

    public static function getCalendar($route_id){
        $calendar = RoutesData::where('route_id', $route_id)->first(['calendar_id']);
        return $calendar;
    }

    /**
     * Obtiene los días fuera de frecuencia asociados a la ruta.
     *
     * @return \App\Models\RoutesData Objeto con los valores de los días fuera de frecuencia (mon, tue, wed, thu, fri, sat, sun)
     */
    public static function getFrequencyDays($route_id)
    {
        return RoutesData::where('route_id', $route_id)->select("mon", "tue", "wed", "thu", "fri", "sat", "sun")->first();
    }

    public function route()
    {
        return $this->belongsTo(Route::class);
    }

    public function calendar()
    {
        return $this->belongsTo(Calendar::class, 'calendar_id');
    }
}
