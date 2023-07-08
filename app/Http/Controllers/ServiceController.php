<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    protected $service;

    public function __construct(Service $service)
    {
        $this->service = $service;
    }
   

}
