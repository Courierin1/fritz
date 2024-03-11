<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;

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
   // protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function redirectTo() {
        // if(Auth::user()->status==1){
            if(Auth::user()->hasRole('admin')){
                $this->redirectTo = '/admin/dashboard';
                return $this->redirectTo;
            }
            else if(Auth::user()->hasRole('user') && Auth::user()->is_planner==1){
                $this->redirectTo = '/planner/dashboard';
                return $this->redirectTo;
            }

            else if(Auth::user()->hasRole('user') && Auth::user()->is_planner==0){
                $this->redirectTo = '/';
                return $this->redirectTo;
            }
       
        //      }
        //       else {

        //   Auth::logout();
        //   $this->redirectTo = '/login';
        //   return $this->redirectTo;
        // }

    }
}
