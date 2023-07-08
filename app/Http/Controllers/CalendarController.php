<?php

namespace App\Http\Controllers;

use App\Models\Calendar;
use App\Models\Route;
use App\Models\RoutesData;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CalendarController extends Controller
{
    protected $calendar;

    public function __construct(Calendar $calendar)
    {
        $this->calendar = $calendar;
    }

    public function index()
    {

        return view('calendar');
    }
}
