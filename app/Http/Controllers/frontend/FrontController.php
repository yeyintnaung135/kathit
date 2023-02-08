<?php

namespace App\Http\Controllers\frontend;

use App\Models\Product;
use App\Models\Banner;

use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
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

    public function product_detail($id) {
      $data = Product::findOrFail($id);
      return view('frontend.product_detail', ['data' => $data]);
    }

}
