<?php

namespace App\Http\Controllers\frontend\Customize;
use App\Models\DressCustomize;
use App\Models\Addtocart;
use App\Models\OrderDressCustomize;

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
      $input=$request->except(['_token', 'product_id', 'color', 'price_per_product']);
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


        // $count = $request->qty;
        $dress_size = DressCustomize::where('user_id', Auth::user()->id)->first();
        
        $dress = OrderDressCustomize::where('user_id', Auth::user()->id)->where('product_id', $request->product_id)->whereNull('payment_id')->first();
        
        if($dress_size) {
          $orderdress = [
            'user_id' => Auth::user()->id,
            'product_id' => $request->product_id,
            'measurement' => $dress_size->measurement,
            'shoulder' => $dress_size->shoulder,
            'chest' => $dress_size->chest,
            'bust' => $dress_size->bust,
            'waist' => $dress_size->waist,
            'hips' => $dress_size->hips,
            'neck' => $dress_size->neck,
            'sleeve' => $dress_size->sleeve,
            'length' => $dress_size->length,
            'waist_to_floor' => $dress_size->waist_to_floor
          ];
          if($dress) {
            OrderDressCustomize::where('user_id', Auth::user()->id)->where('product_id', $request->product_id)->update($orderdress);
          } else {
            OrderDressCustomize::create($orderdress);
          }
        }

        $orderdress = OrderDressCustomize::where('user_id', Auth::user()->id)->where('product_id', $request->product_id)->whereNull('payment_id')->first();
        
        Addtocart::create([
          'user_id' => Auth::user()->id,
          'product_id' => $request->product_id,
          'color_id' => $request->color,
          'order_dress_customize_id' => isset($orderdress->id) ? $orderdress->id : NULL,
          'count' => 1,
          'price_per_product' => $request->price_per_product
        ]);

      // return redirect(url('/product/detail/'.$request->product_id));
      return redirect(url('/addtocart'));
    }

}
