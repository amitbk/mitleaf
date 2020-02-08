<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\FirmPlan;

class CronController extends Controller
{
    public function create_frames()
    {
        // find all active plans
        $active_plans = FirmPlan::where('date_expiry', '>=', now())->get();

        // return date("Y-m-d H:i:s",strtotime('02/13/2020'));

        return $active_plans;
    }
}
