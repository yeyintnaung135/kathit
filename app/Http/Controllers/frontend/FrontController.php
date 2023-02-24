<?php

namespace App\Http\Controllers\frontend;
use Mail;
use App\Models\Product;
use App\Models\Banner;
use App\Models\Video;
use App\Models\Contact;
use App\Mail\ContactMail;
use App\Models\ContactMessage;

use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Request;

class FrontController extends Controller
{
    /**
     * Show the profile for a given user.
     *
     * @param int $id
     * @return \Illuminate\View\View
     */
    public function index()
    {
      $all_products = Product::orderBy('created_at', 'desc')->take(6)->get();
      $dresses = Product::where('category_id', '1')->orderBy('created_at', 'desc')->take(6)->get();
      $mm_dresses = Product::where('category_id', '2')->orderBy('created_at', 'desc')->take(6)->get();
      $men_wears = Product::where('category_id', '3')->orderBy('created_at', 'desc')->take(6)->get();
      $women_wears = Product::where('category_id', '4')->orderBy('created_at', 'desc')->take(6)->get();
      $banners = Banner::all();
      return view('frontend.index', ['all_products'=>$all_products, 'dresses'=>$dresses, 'mm_dresses'=>$mm_dresses, 'men_wears'=>$men_wears, 'women_wears'=>$women_wears, 'banners'=>$banners]);
    }

    public function videos(){
      $videos = Video::latest()->get();
      return view('frontend.videos', ['videos' => $videos]);
    }

    public function about() {
      return view('frontend.about');
    }

    public function contact() {
      $contact = Contact::first();
      return view('frontend.contact',['contact'=>$contact]);
    }

    public function store_message(Request $request) {

      // dd($request);

      $input=$request->except('_token');
      $validator=Validator::make($input,[
        'name'=>['required','max:1000'],
        'email' => 'required|email',
        'phone' => 'required|digits:10|numeric',
        'message' => 'required',
      ]);
      if($validator->fails()){
        return redirect()->back()->withErrors($validator)->withInput();
      }
      ContactMessage::create($input);

      // Mail::to('nyeinyadanartun.moe@gmail.com')->send(new ContactMail($input));
      Mail::to('bebesofia047@gmail.com')->send(new ContactMail($input));

      Session::flash('message', 'Your message was successfully sent');
      return redirect(url('/contact'));
    }
}
