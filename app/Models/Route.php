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
     * Obtiene el rango de fechas inicial y final asociado a la ruta.
     *
     * @return array Arreglo con las fechas de inicio y fin en formato 'Y-m-d'
     */
    public function getRange()
    {
        $range = $this->routeData()->first(['date_init', 'date_finish']);

        $responseData = [
            'date_init' => Carbon::parse($range['date_init'])->format('Y-m-d'),
            'date_finish' => Carbon::parse($range['date_finish'])->format('Y-m-d'),
        ];

        return $responseData;
    }

    /**
     * Obtiene los días fuera de frecuencia asociados a la ruta.
     *
     * @return \App\Models\RoutesData Objeto con los valores de los días fuera de frecuencia (mon, tue, wed, thu, fri, sat, sun)
     */
    public function getFrequencyDays()
    {
        return $this->routeData()->select("mon", "tue", "wed", "thu", "fri", "sat", "sun")->first();
    }

    /**
     * Obtiene los días deshabilitados asociados a la ruta.
     *
     * @return object Objeto JSON con los días deshabilitados en formato 'Y-m-d'
     */
    public function getDaysDisabled()
    {
        $daysDisabled = $this->routeData()->first()->calendar()->first()->daysDisabled()->get('day')->map(function ($day) {
            return Carbon::parse($day['day'])->format('Y-m-d');
        });

        return $daysDisabled;
    }

    /**
     * Obtiene los días de inicio y fin de las reservas asociadas a la ruta.
     *
     * @return \Illuminate\Database\Eloquent\Collection Colección de reservas relacionadas con la ruta
     */
    public function getReservationDays()
    {
        $reservationDays = $this->reservations()->get()->map(function ($reservation) {
            return [
                'start' => Carbon::parse($reservation['reservation_start'])->format('Y-m-d'),
                'end' => Carbon::parse($reservation['reservation_end'])->format('Y-m-d')
            ];
        });

        return $reservationDays;
    }

    /**
     * Obtiene los días de servicio asociados a la ruta.
     *
     * @return \Illuminate\Database\Eloquent\Collection Colección de servicios relacionados con la ruta
     */
    public function getServiceDays()
    {
        $services = $this->services()->get()->map(function ($service) {
            return Carbon::parse($service['timestamp'])->format('Y-m-d');
        })->unique();

        return $services;
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

    //Relations with other models
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
