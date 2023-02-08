<?php

namespace App\Http\Controllers;

use App\Admins;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Carbon;

class AdminController extends Controller
{
    //
    public function __construct(){
        $this->middleware('auth:admins');
    }
    
}
