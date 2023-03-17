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
    
    public function products_search($searchtext = null) {
      $products = Product::where(function ($query) use ($searchtext) {
                    $query->where('brand_code', 'like', '%' . $searchtext . '%')
                      ->orWhere('name', 'like', '%' . $searchtext . '%')
                      ->orWhere('customize_price', 'like', '%' . $searchtext . '%')
                      ->orWhere('s_price', 'like', '%' . $searchtext . '%')
                      ->orWhere('m_price', 'like', '%' . $searchtext . '%')
                      ->orWhere('l_price', 'like', '%' . $searchtext . '%')
                      ->orWhere('xl_price', 'like', '%' . $searchtext . '%')
                      ->orWhere('xxl_price', 'like', '%' . $searchtext . '%')
                      ->orWhere('short_desc', 'like', '%' . $searchtext . '%')
                      ->orWhere('description', 'like', '%' . $searchtext . '%');
                  })->latest()->paginate(8);
      return view('frontend.products.products', ['products' => $products, 'searchtext' => $searchtext]);
    }

    function fetch_data(Request $request)
    {
      if($request->ajax())
      {
        $sort_type = $request->get('sorttype');
        $searchtext = $request->searchtext == null ? '' : $request->searchtext;
        if($sort_type == 2)
        {
          $products = Product::where(function ($query) use ($searchtext) {
                        $query->where('brand_code', 'like', '%' . $searchtext . '%')
                          ->orWhere('name', 'like', '%' . $searchtext . '%')
                          ->orWhere('customize_price', 'like', '%' . $searchtext . '%')
                          ->orWhere('s_price', 'like', '%' . $searchtext . '%')
                          ->orWhere('m_price', 'like', '%' . $searchtext . '%')
                          ->orWhere('l_price', 'like', '%' . $searchtext . '%')
                          ->orWhere('xl_price', 'like', '%' . $searchtext . '%')
                          ->orWhere('xxl_price', 'like', '%' . $searchtext . '%')
                          ->orWhere('short_desc', 'like', '%' . $searchtext . '%')
                          ->orWhere('description', 'like', '%' . $searchtext . '%');
                      })->latest()->paginate(8);
        }
        elseif($sort_type == 3)
        {
          $products = Product::where(function ($query) use ($searchtext) {
                        $query->where('brand_code', 'like', '%' . $searchtext . '%')
                          ->orWhere('name', 'like', '%' . $searchtext . '%')
                          ->orWhere('customize_price', 'like', '%' . $searchtext . '%')
                          ->orWhere('s_price', 'like', '%' . $searchtext . '%')
                          ->orWhere('m_price', 'like', '%' . $searchtext . '%')
                          ->orWhere('l_price', 'like', '%' . $searchtext . '%')
                          ->orWhere('xl_price', 'like', '%' . $searchtext . '%')
                          ->orWhere('xxl_price', 'like', '%' . $searchtext . '%')
                          ->orWhere('short_desc', 'like', '%' . $searchtext . '%')
                          ->orWhere('description', 'like', '%' . $searchtext . '%');
                      })->orderByRaw(
                            "CASE WHEN customize_price THEN customize_price ELSE s_price END ASC"
                      )->paginate(8);
        }
        elseif($sort_type == 4)
        {
          $products = Product::where(function ($query) use ($searchtext) {
                        $query->where('brand_code', 'like', '%' . $searchtext . '%')
                          ->orWhere('name', 'like', '%' . $searchtext . '%')
                          ->orWhere('customize_price', 'like', '%' . $searchtext . '%')
                          ->orWhere('s_price', 'like', '%' . $searchtext . '%')
                          ->orWhere('m_price', 'like', '%' . $searchtext . '%')
                          ->orWhere('l_price', 'like', '%' . $searchtext . '%')
                          ->orWhere('xl_price', 'like', '%' . $searchtext . '%')
                          ->orWhere('xxl_price', 'like', '%' . $searchtext . '%')
                          ->orWhere('short_desc', 'like', '%' . $searchtext . '%')
                          ->orWhere('description', 'like', '%' . $searchtext . '%');
                      })->orderByRaw(
                            "CASE WHEN customize_price THEN customize_price ELSE s_price END DESC"
                      )->paginate(8);
        }
        else
        {
          $products = Product::where(function ($query) use ($searchtext) {
                        $query->where('brand_code', 'like', '%' . $searchtext . '%')
                          ->orWhere('name', 'like', '%' . $searchtext . '%')
                          ->orWhere('customize_price', 'like', '%' . $searchtext . '%')
                          ->orWhere('s_price', 'like', '%' . $searchtext . '%')
                          ->orWhere('m_price', 'like', '%' . $searchtext . '%')
                          ->orWhere('l_price', 'like', '%' . $searchtext . '%')
                          ->orWhere('xl_price', 'like', '%' . $searchtext . '%')
                          ->orWhere('xxl_price', 'like', '%' . $searchtext . '%')
                          ->orWhere('short_desc', 'like', '%' . $searchtext . '%')
                          ->orWhere('description', 'like', '%' . $searchtext . '%');
                      })->latest()->paginate(8);
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
          $products = Product::where('category_id',$request->cate_id)
          ->orderByRaw(
                "CASE WHEN customize_price THEN customize_price ELSE s_price END ASC"
          )->paginate(8);
        }
        elseif($sort_type == 4)
        {
          $products = Product::where('category_id',$request->cate_id)->orderByRaw(
                "CASE WHEN customize_price THEN customize_price ELSE s_price END DESC"
          )->paginate(8);
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

      $min = $data->customize_price ? $data->customize_price - (($data->customize_price * 20) / 100) : $data->s_price - (($data->s_price * 20) / 100);
      $max = $data->customize_price ? $data->customize_price + (($data->customize_price * 20) / 100) : $data->xxl_price - (($data->xxl_price * 20) / 100);
      $sim = Product::
              where(function ($query) use ($min, $max) {
                $query->where('customize_price', '>=', $min)
                      ->where('customize_price', '<=', $max);
              })
              ->orWhere(function ($query) use ($min, $max) {
                $query->where('s_price', '>=', $min)
                      ->where('xxl_price', '<=', $max);
              })
             ->where('category_id', $data->category_id)->where('id', '!=', $data->id)
             ->orderByRaw(
                  "CASE WHEN customize_price THEN customize_price ELSE s_price END ASC"
             )
             ->limit(10)->get();
      
      $colors = Color::whereIn('id', json_decode($data->color))->get();

      return view('frontend.products.product_detail', ['data' => $data, 'sim' => $sim, 'colors'=>$colors]);
    }
}
