<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Route extends Model
{
    use HasFactory;

    /**
     * Obtiene las rutas que tienen datos dentro del rango de fechas especificado.
     *
     * @param string $start_date Fecha de inicio en formato 'd/m/Y'
     * @param string $end_date   Fecha de fin en formato 'd/m/Y'
     * @return \Illuminate\Database\Eloquent\Collection Colección de rutas que cumplen con el rango de fechas
     */
    public function getRouteByRange($start_date, $end_date)
    {
        $startDate = Carbon::createFromFormat('d/m/Y', $start_date)->format('Y-m-d');
        $endDate = Carbon::createFromFormat('d/m/Y', $end_date)->format('Y-m-d');

        $routes = $this->select('id', 'title')->whereHas('routeData', function ($query) use ($startDate, $endDate) {
            $query->where(function ($query) use ($startDate, $endDate) {
                $query->whereBetween('date_init', [$startDate, $endDate])
                    ->orWhereBetween('date_finish', [$startDate, $endDate]);
            });
        })->get();

        return $routes;
    }


    /**
     * Obtiene los días con capacidad completa de la ruta.
     *
     * @param integer $pax           Número de pasajeros
     * @param array   $service_days  Días de servicio de la ruta
     * @return array Arreglo con los días con capacidad completa en formato 'Y-m-d'
     */
    public function getFullRouteCapacityDays($pax, $service_days)
    {
        $services_count_per_day = $this->calculateServicesCountPerDay($service_days);

        $full_route_days = array_filter($services_count_per_day, function ($day) use ($pax) {
            return $day >= $pax;
        });

        $full_route_days = array_keys($full_route_days);

        return $full_route_days;
    }

    /**
     * Calcula el número de servicios por día.
     *
     * @param array $service_days Días de servicio de la ruta
     * @return array Arreglo asociativo con el conteo de servicios por día
     */
    private function calculateServicesCountPerDay($service_days)
    {
        $countedData = array_count_values(array_map('strval', collect($service_days)->toArray()));
        return $countedData;
    }

    // Relaciones con otros modelos

    public function routeData()
    {
        return $this->hasMany(RoutesData::class);
    }

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }

    public function services()
    {
        return $this->hasMany(Service::class, 'external_route_id', 'external_id');
    }
}
