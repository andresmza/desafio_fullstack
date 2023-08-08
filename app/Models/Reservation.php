<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    /**
     * Obtiene los días de inicio y fin de las reservas asociadas a la ruta.
     *
     * @return \Illuminate\Database\Eloquent\Collection Colección de reservas relacionadas con la ruta
     */
    public static function getReservationDays($route_id)
    {

        $reservationDays = Reservation::where('route_id', $route_id)->get(['reservation_start', 'reservation_end'])->map(function ($reservation) {
            return [
                'start' => Carbon::parse($reservation['reservation_start'])->format('Y-m-d'),
                'end' => Carbon::parse($reservation['reservation_end'])->format('Y-m-d')
            ];
        });

        return $reservationDays;
    }

    public function userPlan()
    {
        return $this->belongsTo(UserPlan::class);
    }

    public function route()
    {
        return $this->belongsTo(Route::class);
    }
}
