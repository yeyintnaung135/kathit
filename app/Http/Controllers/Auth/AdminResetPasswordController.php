<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;

class AdminResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use ResetsPasswords;

    protected $redirectTo = '/backend/home';
    
    public function __construct()
    {
        $this->middleware('guest:admins');
    }
    public function showResetForm(Request $request, $token = null)
    {
        return view('auth.admin.adminreset')->with(['token' => $token, 'email' => $request->email]);
    }
    protected function guard()
    {
      return Auth::guard('admins');
    }
    protected function broker()
    {
        return Password::broker('admins');
    }
}
