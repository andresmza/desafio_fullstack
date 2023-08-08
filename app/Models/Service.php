<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

     /**
     * Obtiene los días de servicio asociados a la ruta.
     *
     * @return \Illuminate\Database\Eloquent\Collection Colección de servicios relacionados con la ruta
     */
    public static function getServiceDays($external_id){

        $serviceDays = Service::where('external_route_id', $external_id)->get('timestamp')->map(function ($service) {
            return Carbon::parse($service['timestamp'])->format('Y-m-d');
        });

        return $serviceDays;
    }

    //Relations
    public function route()
    {
        return $this->belongsTo(Route::class, 'external_route_id', 'external_id');
    }
}
