<?php

namespace App\Http\Controllers\frontend\Customize;
use App\Models\SuitCustomize;
use App\Models\OrderSuitCustomize;
use App\Models\Addtocart;

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

        // $count = $request->qty;
      $suit_size = SuitCustomize::where('user_id', Auth::user()->id)->first();

      $suit = OrderSuitCustomize::where('user_id', Auth::user()->id)->where('product_id', $request->product_id)->whereNull('payment_id')->first();
      if($suit_size) {
        $ordersuit = [
          'user_id' => Auth::user()->id,
          'product_id' => $request->product_id,
          'measurement' => $suit_size->measurement,
          'shoulder' => $suit_size->shoulder,
          'chest' => $suit_size->chest,
          'neck' => $suit_size->neck,
          'sleeve' => $suit_size->sleeve,
          'top_length' => $suit_size->top_length,
          'waist' => $suit_size->waist,
          'hips' => $suit_size->hips,
          'pants_length' => $suit_size->pants_length,
          'thigh_length' => $suit_size->thigh_length,
          'leg_opening' => $suit_size->leg_opening,
          'inseam' => $suit_size->inseam,
        ];
        if($suit) {
          OrderSuitCustomize::where('user_id', Auth::user()->id)->where('product_id', $request->product_id)->update($ordersuit);
        } else {
          OrderSuitCustomize::create($ordersuit);
        }
      }

      $ordersuit = OrderSuitCustomize::where('user_id', Auth::user()->id)->where('product_id', $request->product_id)->whereNull('payment_id')->first();
      
      Addtocart::create([
        'user_id' => Auth::user()->id,
        'product_id' => $request->product_id,
        'color_id' => $request->color,
        'order_suit_customize_id' => isset($ordersuit->id) ? $ordersuit->id : NULL,
        'count' => 1,
        'price_per_product' => $request->price_per_product
      ]);
      // return redirect(url('/product/detail/'.$request->product_id));
      return redirect(url('/addtocart'));
    }

}
