<?php

namespace App\Http\Controllers;

use App\Models\RoutesData;
use Illuminate\Http\Request;

class RoutesDataController extends Controller
{
    protected $routesData;

    public function __construct(RoutesData $routesData)
    {
        $this->routesData = $routesData;
    }
}
