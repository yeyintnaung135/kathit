<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Request;

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
        $this->middleware('guest')->except('logout','adminlogout');
        $this->middleware('guest:admins')->except('logout','adminlogout');
    }

    public function showAdminLoginForm()
    {
        return view('backend.admin.auth.login', ['url' => 'adminlogin']);
    }

    public function adminLogin(Request $request)
    {
        $this->validate($request, [
            'email'   => 'required|email',
            'password' => 'required|min:6'
        ]);

        if (Auth::guard('admins')->attempt(['email' => $request->email, 'password' => $request->password], $request->get('remember'))) {
            return redirect()->intended('/backend/home');
        }
        return back()->withInput($request->only('email', 'remember'))->withErrors(['failadminlogin'=>'Wrong Credentials']);
    }

    public function adminlogout()
    {
        Auth::guard('admins')->logout();
        return redirect(url('adminlogin'));
    }
}
