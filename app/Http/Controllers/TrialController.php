<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TrialController extends Controller
{
  /**
   * Show the page to register for trial with mobile and Business name.
   *
   * @return \Illuminate\Http\Response
   */
  public function start()
  {
    $users = User::latest()->paginate(10);
    return view('admin.users.index', compact('users'));
  }
}
