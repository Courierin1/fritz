<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\CompanySetting;
use App\UserDetail;
use Auth;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';
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

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'fname' => ['required', 'string', 'max:255'],
            'lname' => ['required', 'string', 'max:255'],
            'dob' => ['required'],
            'phone' =>  ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
         $user= User::create([
            'name' => $data['fname']." ".$data['lname'],
            'is_planner' => $data['role'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
        $userRole = config('roles.models.role')::where('name', '=', 'User')->first();
        $user->attachRole($userRole);
        $distribution = CompanySetting::where('key', 'DISTRIBUTION')->first();
        $ticket_id = rand().$user->id;
        User::where('id',$user->id)->update(['ticket_id' => $ticket_id]);
        UserDetail::create([
            'user_id' => $user->id,
            'distribution' => $distribution->value ?? '9',
            'first_name' => $data['fname'] ?? '',
            'last_name' => $data['lname'] ?? '',
            'dob' => $data['dob'] ?? '',
            'cell_phone' => $data['phone'] ?? ''
        ]);

        return $user;
    }
}
