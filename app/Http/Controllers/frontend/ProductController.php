<?php

namespace App\Http\Controllers\frontend;
use Mail;
use App\Models\Product;
use App\Models\Color;

use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Request;

class ProductController extends Controller
{
    /**
     * Show the profile for a given user.
     *
     * @param int $id
     * @return \Illuminate\View\View
     */

    public function products() {
      $products = Product::latest()->paginate(8);
      return view('frontend.products.products', ['products' => $products]);
    }

    function fetch_data(Request $request)
    {
      if($request->ajax())
      {
        $sort_type = $request->get('sorttype');
        if($sort_type == 2)
        {
          $products = Product::latest()->paginate(8);
        }
        elseif($sort_type == 3)
        {
          $products = Product::orderBy('price','asc')->paginate(8);
        }
        elseif($sort_type == 4)
        {
          $products = Product::orderBy('price','desc')->paginate(8);
        }
        else
        {
          $products = Product::latest()->paginate(8);
        }

        logger($products);
        return view('frontend.products.shop_product', compact('products'))->render();
      }
    }

    public function productsByCat($category, $id) {
      $products = Product::latest()->where('category_id', $id)->paginate(8);
      return view('frontend.products.productsbycat', ['products' => $products, 'cat' => $category,'cate_id' => $id]);
    }

    function category_fetch_data(Request $request)
    {
      if($request->ajax())
      {
        $sort_type = $request->get('sorttype');
        if($sort_type == 2)
        {
          $products = Product::where('category_id',$request->cate_id)->latest()->paginate(8);
        }
        elseif($sort_type == 3)
        {
          $products = Product::where('category_id',$request->cate_id)->orderBy('price','asc')->paginate(8);
        }
        elseif($sort_type == 4)
        {
          $products = Product::where('category_id',$request->cate_id)->orderBy('price','desc')->paginate(8);
        }
        else
        {
          $products = Product::where('category_id',$request->cate_id)->latest()->paginate(8);
        }
        return view('frontend.products.shop_product_by_cat', compact('products'))->render();
      }
    }

    public function product_detail($id) {
      $data = Product::findOrFail($id);

      $min = $data->price - (($data->price * 20) / 100);
      $max = $data->price + (($data->price * 20) / 100);
      $sim = Product::where('price', '>=', $min)->where('price', '<=', $max)->where('category_id', $data->category_id)->where('id', '!=', $data->id)->orderBy('price', 'asc')->limit(10)->get();
      
      $colors = Color::whereIn('id', json_decode($data->color))->get();

      return view('frontend.products.product_detail', ['data' => $data, 'sim' => $sim, 'colors'=>$colors]);
    }
}