<?php

namespace App\Http\Controllers;

use App\Models\UserPlan;
use Illuminate\Http\Request;

class UserPlanController extends Controller
{
    protected $userPlan;

    public function __construct(UserPlan $userPlan)
    {
        $this->userPlan = $userPlan;
    }
}
