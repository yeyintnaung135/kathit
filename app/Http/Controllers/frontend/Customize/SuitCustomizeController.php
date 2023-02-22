<?php

namespace App\Http\Controllers\frontend\Customize;
use App\Models\SuitCustomize;

use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Request;

class SuitCustomizeController extends Controller
{
    /**
     * Show the profile for a given user.
     *
     * @param int $id
     * @return \Illuminate\View\View
     */

    public function suitcustomize (Request $request) {
      // dd($request);
      $input=$request->except('_token');
      $input=$request->except('product_id');
      $validator=Validator::make($input,[
        'shoulder'=>['required', 'string', 'max:8'],
        'chest' => ['required', 'string', 'max:8'],
        'neck' => ['required', 'string', 'max:8'],
        'sleeve' => ['required', 'string', 'max:8'],
        'top_length' => ['required', 'string', 'max:8'],
        'waist' => ['required', 'string', 'max:8'],
        'hips' => ['required', 'string', 'max:8'],
        'pants_length' => ['required', 'string', 'max:8'],
        'thigh_length' => ['required', 'string', 'max:8'],
        'leg_opening' => ['required', 'string', 'max:8'],
        'inseam' => ['required', 'string', 'max:8'],
      ]);
      if($validator->fails()){
        return redirect()->back()->withErrors($validator)->withInput();
      }
      SuitCustomize::updateOrCreate(['user_id' => $input['user_id']], $input);
      return redirect(url('/product/detail/'.$request->product_id));
    }

}
