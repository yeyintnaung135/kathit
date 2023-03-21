<?php

namespace App\Http\Controllers\Auth;

use App\Models\Admins;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Request;

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
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
        $this->middleware('guest:admins');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
      if(is_numeric($data['email'])) {
        return Validator::make($data, [
          'name' => ['required', 'string', 'max:255'],
          'email' => ['required', 'regex:/^([0-9\s\-\+\(\)]*)$/', 'min:10', 'unique:users'],
          'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
      } else {
        return Validator::make($data, [
          'name' => ['required', 'string', 'max:255'],
          'email' => ['required', 'string', 'max:255', 'unique:users'],
          'password' => ['required', 'string', 'min:8', 'confirmed'],
      ]);
      }
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
      if(is_numeric($data['email'])) {
        $email = 'mobile_number';
      } else {
        $email = 'email';
      }
      return User::create([
        'name' => $data['name'],
        $email => $data['email'],
        'password' => Hash::make($data['password']),
      ]);
    }

    public function showAdminRegisterForm()
    {
        return view('auth.admin.register', ['url' => 'adminregister']);
    }
    
    public function adminregister(Request $request)
    {
        $this->validator($request->all())->validate();

       Admins::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
            'role'=>'admin',
        ]);
        return redirect()->intended('adminlogin');

    }
}
