<?php

namespace App\Http\Controllers\frontend;
use Mail;

use App\Models\DressCustomize;
use App\Models\SuitCustomize;
use App\Models\Addtocart;
use App\Models\Payment;
use App\Models\Product;
use App\Models\OrderDressCustomize;
use App\Models\OrderSuitCustomize;
use App\Models\Billingaddress;
use App\Models\OrderBillingaddress;
use App\Models\OrderProduct;
use App\Models\User;

use App\Rules\MatchOldPassword;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
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
        $user = Auth::guard('web')->user();
        if(session()->get('product_id')) {
          $product_id = session()->get('product_id');
          session()->forget('product_id');
          return redirect('/product/detail/'.$product_id);
        } else {
          return view('frontend.account.account', ['user' => $user]);
        }
      } else {
        return redirect('/login');
      }
    }

    public function editaccount(Request $request) {
      $input=$request->except('_token');
      $validator=Validator::make($input,[
        'name'=>['required','max:1000'],
        'email' => 'required|email',
      ]);
      if($validator->fails()){
        return redirect()->back()->withErrors($validator)->withInput();
      }
      $input['user_id'] = Auth::user()->id;
      $result = User::updateOrCreate(['id' => $input['user_id']], $input);
      if($result){
        return redirect()->back()->with('success','Update successfully!');
      }
    }

    public function getorders() {
      if(Auth::check() and Auth::user()->role='user') {
        $orders = Payment::where('user_id', Auth::guard('web')->user()->id)->orderBy('id','desc')->get();
        return view('frontend.account.orders', ['orders' => $orders]);
      } else {
        return redirect('/login');
      }
    }

    public function view_order($id) {
      if(Auth::check() and Auth::user()->role='user') {
        $payment = Payment::where('id', $id)->first();
        $billing = OrderBillingaddress::where('payment_id', $payment->id)->first();
        $orders = OrderProduct::where('payment_id', $payment->id)->whereIn('product_id', json_decode($payment->product_id))->get();
        return view('frontend.account.view_order', ['payment' => $payment, 'billing' => $billing, 'orders' => $orders]);
      } else {
        return redirect('/login');
      }
    }

    public function getbillingaddress() {
      $billing = Billingaddress::where('user_id', Auth::user()->id)->first();
      if(Auth::check() and Auth::user()->role='user') {
        return view('frontend.account.billing', ['billing' => $billing]);
      } else {
        return redirect('/login');
      }
    }

    public function editbillingaddress(Request $request) {
      $input=$request->except('_token');
      $validator=Validator::make($input,[
        'name'=>['required','max:1000'],
        'email' => 'required|email',
        'phone' => 'required|numeric',
        'address' => 'required',
        'state'=>['required','max:1000'],
        'city'=>['required','max:1000']
      ]);
      if($validator->fails()){
        return redirect()->back()->withErrors($validator)->withInput();
      }
      $input['user_id'] = Auth::user()->id;
      $result = Billingaddress::updateOrCreate(['user_id' => $input['user_id']], $input);
      if($result){
        return redirect()->back()->with('success','Update successfully!');
      }
    }

    public function getchangepassword() {
      if(Auth::check() and Auth::user()->role='user') {
        return view('frontend.account.password');
      } else {
        return redirect('/login');
      }
    }

    public function editchangepassword(Request $request) {
      $input=$request->except('_token');
      $validator=Validator::make($input,[
        'current_password'=>['required','min:8', new MatchOldPassword],
        'new_password' => ['required','min:8','different:current_password'],
        'new_confirm_password' => 'same:new_password',
      ]);
      if($validator->fails()){
        return redirect()->back()->withErrors($validator)->withInput();
      }
      $user = User::findOrFail(Auth::user()->id);
      $user->password = Hash::make($request->new_password);
      $result = $user->update();
      if($result){
        return redirect()->back()->with('success','Update successfully!');
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
        'phone' => 'required|numeric',
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

    public function checkout(Request $request) {
      $input=$request->except('_token');
      if($input['payment_method'] == 'Direct Bank') {
        $validator=Validator::make($input,[
          'payment_screenshot'=>['required','mimes:jpeg,bmp,png,jpg']
        ]);
        if($validator->fails()){
          return redirect()->back()->withErrors($validator)->withInput();
        }
        $img = $input['payment_screenshot'];
  
        $imageNameone = time().'img'.'.'.$img->getClientOriginalExtension();
  
        $lpath=$img->move(public_path('images/payments/'),$imageNameone);
        $input['payment_screenshot']='images/payments/'.$imageNameone;
      } else {
        $input['payment_screenshot']= NULL;
      }
      $products_id = Product::leftjoin('addtocart', 'products.id', '=', 'addtocart.product_id')
                    ->where('addtocart.user_id', Auth::user()->id)
                    ->pluck('addtocart.product_id');
      $p_ids = [];
      foreach ($products_id as $p_id) {
        array_push($p_ids, $p_id);
      }
      $input['user_id'] = Auth::user()->id;
      $input['product_id'] = json_encode($p_ids);
      
      $payment = Payment::create($input);
      OrderDressCustomize::where('user_id', Auth::user()->id)->whereNull('payment_id')->whereIn('product_id',$p_ids)->update(['payment_id' => $payment->id]);
      OrderSuitCustomize::where('user_id', Auth::user()->id)->whereNull('payment_id')->whereIn('product_id',$p_ids)->update(['payment_id' => $payment->id]);

      $billing_address = Billingaddress::where('user_id', Auth::user()->id)->first();
      $order_billing_address = [
        'user_id' => Auth::user()->id,
        'name' => $billing_address->name,
        'phone' => $billing_address->phone,
        'email' => $billing_address->email,
        'address' => $billing_address->address,
        'state' => $billing_address->state,
        'city' => $billing_address->city,
        'payment_id' => $payment->id
      ];

      OrderBillingaddress::create($order_billing_address);

      $add_to_cart = Addtocart::where('user_id', Auth::user()->id)->get();
      foreach ($add_to_cart as $atc) {
        $order_product = [
          'user_id' => Auth::user()->id,
          'product_id' => $atc->product_id,
          'payment_id' => $payment->id,
          'count' => $atc->count,
          'color_id' => $atc->color_id,
          'readytowear_size' => $atc->readytowear_size,
        ];
        OrderProduct::create($order_product);
      }

      Addtocart::where('user_id', Auth::user()->id)->whereIn('product_id',$p_ids)->delete();
      return redirect(url('/account/orders'));
    }
}
