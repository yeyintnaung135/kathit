<?php

namespace App\Http\Controllers\frontend;
use Mail;

use App\Models\DressCustomize;
use App\Models\SuitCustomize;
use App\Models\Addtocart;
use App\Models\Product;
use App\Models\OrderDressCustomize;
use App\Models\OrderSuitCustomize;
use App\Models\Billingaddress;
use App\Models\OrderBillingaddress;

use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Request;

class AccountController extends Controller
{
    /**
     * Show the profile for a given user.
     *
     * @param int $id
     * @return \Illuminate\View\View
     */

    public function account() {
      if(Auth::check() and Auth::user()->role='user') {
        if(session()->get('product_id')) {
          $product_id = session()->get('product_id');
          session()->forget('product_id');
          return redirect('/product/detail/'.$product_id);
        } else {
          return view('frontend.account.account');
        }
      } else {
        return redirect('/login');
      }
    }

    public function customize($id) {
      if(Auth::check() and Auth::user()->role='user') {
        $dress = DressCustomize::where('user_id', Auth::user()->id)->first();
        $suit = SuitCustomize::where('user_id', Auth::user()->id)->first();

        return view('frontend.account.customize', ['user_id' => Auth::user()->id, 'product_id' => $id, 'dress' => $dress, 'suit' => $suit]);
      } else {
        session()->put('product_id', $id);
        return redirect('/login');
      }
    }

    public function addtocart() {
      if(Auth::check() and Auth::user()->role='user') {
        $products = Product::leftjoin('addtocart', 'products.id', '=', 'addtocart.product_id')
                    ->where('addtocart.user_id', Auth::user()->id)
                    ->get();
        return view('frontend.checkout.addtocart', ['products' => $products]);
      } else {
        return redirect('/login');
      }
    }

    public function billingaddress() {
      if(Auth::check() and Auth::user()->role='user') {
        $products = Product::leftjoin('addtocart', 'products.id', '=', 'addtocart.product_id')
                    ->where('addtocart.user_id', Auth::user()->id)
                    ->get();
        $billing = Billingaddress::where('user_id', Auth::user()->id)->first();
        return view('frontend.checkout.billingaddress', ['products' => $products, 'billing' => $billing]);
      } else {
        return redirect('/login');
      }
    }

    public function storebillingaddress(Request $request) {
      $input=$request->except('_token');
      $validator=Validator::make($input,[
        'name'=>['required','max:1000'],
        'email' => 'required|email',
        'phone' => 'required|digits:10|numeric',
        'address' => 'required',
        'state'=>['required','max:1000'],
        'city'=>['required','max:1000']
      ]);
      if($validator->fails()){
        return redirect()->back()->withErrors($validator)->withInput();
      }
      $input['user_id'] = Auth::user()->id;
      Billingaddress::updateOrCreate(['user_id' => $input['user_id']], $input);
      return redirect(url('/payment'));
    }

    public function payment() {
      if(Auth::check() and Auth::user()->role='user') {
        $products = Product::leftjoin('addtocart', 'products.id', '=', 'addtocart.product_id')
                    ->where('addtocart.user_id', Auth::user()->id)
                    ->get();
        return view('frontend.checkout.payment', ['products' => $products]);
      } else {
        return redirect('/login');
      }
    }

    public function checkout() {
      return 'checkout';
    }

    public function storeproducttocart(Request $request) {
      if(Auth::check() and Auth::user()->role='user') {
        $qty = Addtocart::select('count')->where('user_id', Auth::user()->id)->where('product_id', $request->product_id)->first();

        // Ready to Wear
        if($request->readytowear_size) {
          if($qty) {
            $count = $qty->count + $request->qty;
            Addtocart::where('user_id', Auth::user()->id)->where('product_id', $request->product_id)->update(['count' => $count]);
          } else {
            $count = $request->qty;
            Addtocart::create(['user_id' => Auth::user()->id,'product_id' => $request->product_id,'color_id' => $request->color,'readytowear_size' => $request->readytowear_size,'count' => $request->qty]);
          }
          return response()->json(['count' => $count]);
        } 
        // Customize
        else 
        {
          if($qty) {
            $count = $qty->count + $request->qty;
            Addtocart::where('user_id', Auth::user()->id)->where('product_id', $request->product_id)->update(['count' => $count]);
          } else {
            $count = $request->qty;
            $dress_size = DressCustomize::where('user_id', Auth::user()->id)->first();
            $suit_size = SuitCustomize::where('user_id', Auth::user()->id)->first();
            
            if($dress_size || $suit_size) {

              $dress = OrderDressCustomize::where('user_id', Auth::user()->id)->where('product_id', $request->product_id)->whereNull('payment_id')->first();
              $suit = OrderSuitCustomize::where('user_id', Auth::user()->id)->where('product_id', $request->product_id)->whereNull('payment_id')->first();
              
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

              $orderdress = OrderDressCustomize::where('user_id', Auth::user()->id)->where('product_id', $request->product_id)->whereNull('payment_id')->first();
              $ordersuit = OrderSuitCustomize::where('user_id', Auth::user()->id)->where('product_id', $request->product_id)->whereNull('payment_id')->first();
              
              Addtocart::create([
                'user_id' => Auth::user()->id,
                'product_id' => $request->product_id,
                'color_id' => $request->color,
                'order_dress_customize_id' => isset($orderdress->id) ? $orderdress->id : NULL,
                'order_suit_customize_id' => isset($ordersuit->id) ? $ordersuit->id : NULL,
                'count' => $request->qty
              ]);
            } else {
              return response()->json(['error' => 'needtocustomize', 'product_id' => $request->product_id]);
            }
          }
          return response()->json(['count' => $count]);
        }
      } else {
        session()->put('product_id', $request->product_id);
        return response()->json(['error' => 'needtologin']);
      }
    }

    public function updatecart(Request $request) {
      $qty = Addtocart::select('count')->where('user_id', Auth::user()->id)->where('id', $request->id)->first();
      
      if($request->type == 'plus') {
        $count = $qty->count + $request->qty;
        Addtocart::where('user_id', Auth::user()->id)->where('id', $request->id)->update(['count' => $count]);
      } else if($request->type == 'minus') {
        $count = $qty->count - $request->qty;
        if($count == 0) {
          $addtocartdress = Addtocart::where('user_id', Auth::user()->id)->where('id', $request->id)->first();
          $addtocartsuit = Addtocart::where('user_id', Auth::user()->id)->where('id', $request->id)->first();
          
          Addtocart::where('user_id', Auth::user()->id)->where('id', $request->id)->delete();

          OrderDressCustomize::where('id', $addtocartdress->order_dress_customize_id)->whereNull('payment_id')->delete();
          OrderSuitCustomize::where('id', $addtocartsuit->order_suit_customize_id)->whereNull('payment_id')->delete();
        } else {
          Addtocart::where('user_id', Auth::user()->id)->where('id', $request->id)->update(['count' => $count]);
        }
      } else {
        return;
      }
    }
}
