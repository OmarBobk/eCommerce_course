<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

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
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function username()
    {
        return 'username';
    }

    public function redirectTo()
    {
        $allowed_route = auth()->user()->roles()->first()->allowed_route;
        if ( $allowed_route != '' ) {
            return $this->redirectTo = $allowed_route . '/index';
        }
    }

    protected function loggedOut(Request $request)
    {

        if (Cache::has('logged_user_allowed_routes')) {
            Cache::forget('logged_user_allowed_routes');
        }
        if (Cache::has('role_routes')) {
            Cache::forget('role_routes');
        }
        if (Cache::has('admin_side_menu')) {
            Cache::forget('admin_side_menu');
        }
    }

}
