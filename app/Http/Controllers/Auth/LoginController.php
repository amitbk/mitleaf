<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\User;
use App\Firm;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    // protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    protected function redirectTo()
    {
        return $this->beforeRedirectLogic();
    }

    public static function beforeRedirectLogic()
    {
        // if no firm after new registration, create a simple firm
        // var_dump(auth()->id());die();
        if(auth()->user()->firms->count() == 0)
        {
            $firm = new Firm;
            $firm->name = auth()->user()->name."'s Business";
            $firm->save();
            $firm->users()->attach(auth()->user());
        }
        // if(auth()->user()->firms)
        if (auth()->user()->role_id == 1) {
            return '/admin';
        }
        return '/home';
    }
}
