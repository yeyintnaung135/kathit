<?php

namespace App\Http\Controllers\frontend\Customize;
use App\Models\DressCustomize;

use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Request;

class DressCustomizeController extends Controller
{
    /**
     * Show the profile for a given user.
     *
     * @param int $id
     * @return \Illuminate\View\View
     */

    public function dresscustomize (Request $request) {
      // dd($request);
      $input=$request->except('_token');
      $input=$request->except('product_id');
      $validator=Validator::make($input,[
        'shoulder'=>['required', 'string', 'max:8'],
        'chest' => ['required', 'string', 'max:8'],
        'bust' => ['required', 'string', 'max:8'],
        'waist' => ['required', 'string', 'max:8'],
        'hips' => ['required', 'string', 'max:8'],
        'neck' => ['required', 'string', 'max:8'],
        'sleeve' => ['required', 'string', 'max:8'],
        'length' => ['required', 'string', 'max:8'],
        'waist_to_floor' => ['required', 'string', 'max:8'],
      ]);
      if($validator->fails()){
        return redirect()->back()->withErrors($validator)->withInput();
      }
      DressCustomize::updateOrCreate(['user_id' => $input['user_id']], $input);
      return redirect(url('/product/detail/'.$request->product_id));
    }

}
