<?php

namespace App\Http\Controllers;

use App\Models\Route;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class RouteController extends Controller
{
    protected $route;

    public function __construct(Route $route)
    {
        $this->route = $route;
    }

    /**
     * Obtener rutas por rango de fechas
     *
     * @param  Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getRoutes(Request $request)
    {
        // Definir reglas de validación
        $rules = [
            'start_date' => 'required|date_format:d/m/Y',
            'end_date' => 'required|date_format:d/m/Y',
        ];

        // Validar los datos de la solicitud
        $validator = Validator::make($request->all(), $rules);

        // Si la validación falla, devolver los errores de validación
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // Obtener las rutas por rango de fechas
        $routes = $this->route->getRouteByRange($request->start_date, $request->end_date);

        // Devolver las rutas como una respuesta JSON
        return response()->json($routes, 200);
    }

    /**
     * Obtener datos de una ruta
     *
     * @param  Route  $route
     * @return \Illuminate\Http\JsonResponse
     */
    public function getRouteData(Route $route)
    {
        // Validar el ID de la ruta
        $validator = Validator::make(['id' => $route->id], [
            'id' => 'exists:routes',
        ]);

        // Si la validación falla, devolver los errores de validación
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // Obtener el rango de la ruta
        $range = $route->getRange();

        // Obtener los días deshabilitados para la ruta
        $daysDisabled = $route->getDaysDisabled();

        // Obtener los días fuera de frecuencia para la ruta
        $frequencyDays = $route->getFrequencyDays();

        // Obtener los días de reserva para la ruta
        $reservationDays = $route->getReservationDays();

        // Obtener los días de servicio para la ruta
        $serviceDays = $route->getServiceDays();

        // Obtener los días con capacidad completa de la ruta
        $fullRouteCapacityDays = $route->getFullRouteCapacityDays($route->pax, $serviceDays);

        // Preparar los datos de la respuesta
        $response = [
            'route' => [
                'range' => $range,
                'days_disabled' => $daysDisabled,
                'frequency_days' => $frequencyDays,
                'reservation_days' => $reservationDays,
                'service_days' => $serviceDays,
                'full_route_capacity_days' => $fullRouteCapacityDays,
            ]
        ];

        // Devolver la respuesta en formato JSON
        return response()->json($response, 200);
    }
}
