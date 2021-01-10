<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Firm;
use App\Template;
use App\Order;

class AdminController extends Controller
{
    public function dashboard()
    {
      $users_count = User::get()->count();
      $firms_count = Firm::get()->count();
      $templates_count = Template::get()->count();
      $orders_count = Order::get()->count();

      return view('admin.dashboard.index', compact('users_count', 'firms_count', 'templates_count', 'orders_count') );
    }
}
