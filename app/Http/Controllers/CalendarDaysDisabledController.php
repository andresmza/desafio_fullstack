<?php

namespace App\Http\Controllers;

use App\Models\CalendarDaysDisabled;
use Illuminate\Http\Request;

class CalendarDaysDisabledController extends Controller
{
    protected $calendarDaysDisabled;

    public function __construct(CalendarDaysDisabled $calendarDaysDisabled)
    {
        $this->calendarDaysDisabled = $calendarDaysDisabled;
    }

}
