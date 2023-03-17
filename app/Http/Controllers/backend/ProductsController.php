<?php

namespace App\Http\Controllers\backend;

use App\Models\Product;
use App\Models\ProductPhoto;
use App\Models\Color;
use App\Models\Addtocart;
use App\Models\OrderDressCustomize;
use App\Models\OrderSuitCustomize;

use App\Admins;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Carbon;

class ProductsController extends Controller
{
    //
    public function __construct(){
      $this->middleware('auth:admins');
    }
    public function list(){
      return view('backend.products.list');
    }

    public function create() {
      $colors = Color::orderBy('name', 'asc')->get();
      return view('backend.products.create', ['colors' => $colors]);
    }

    public function store(Request $request){
      $request->validate([
        'type'=>['required'],
      ]);
      if(in_array('readytowear', $request->type)) {
        $request->validate([
          'name'=>['required','max:1000'],
          'type'=>['required'],
          'brand_code'=>['required','max:1000'],
          'product_image'=>['required'],
          's_price'=>['required','integer'],
          'm_price'=>['required','integer'],
          'l_price'=>['required','integer'],
          'xl_price'=>['required','integer'],
          'xxl_price'=>['required','integer'],
          'short_desc'=>['required'],
          'description'=>['required']
        ]);
      }
      if(in_array('customize', $request->type)) {
        $request->validate([
          'name'=>['required','max:1000'],
          'type'=>['required'],
          'brand_code'=>['required','max:1000'],
          'product_image'=>['required'],
          'customize_price'=>['required','integer'],
          'short_desc'=>['required'],
          'description'=>['required']
        ]);
      }

      $product = new Product();
      $product->name = $request->name;
      $product->customize_price = $request->customize_price;
      $product->s_price = $request->s_price;
      $product->m_price = $request->m_price;
      $product->l_price = $request->l_price;
      $product->xl_price = $request->xl_price;
      $product->xxl_price = $request->xxl_price;
      $product->brand_code = $request->brand_code;
      $product->category_id = $request->category_id;
      $product->short_desc = $request->short_desc;
      $product->description = $request->description;
      $product->type = json_encode($request->type);
      $product->color = $request->color;
      $product->save();

      $folderPath = 'images/products/';
      if($request->product_image){
        foreach($request->product_image as $re){
          $photo = new ProductPhoto();
          $photo->product_id = $product->id;
        
          $image_parts = explode(";base64,", $re);
          $image_type_aux = explode("image/", $image_parts[0]);
          // $image_type = $image_type_aux[1];
          $image_base64 = base64_decode($image_parts[1]);
    
          $imageName = uniqid().'_product' . '.png';
    
          $imageFullPath = public_path($folderPath.$imageName);
  
          file_put_contents($imageFullPath, $image_base64);
          $photo->product_image = $folderPath.$imageName;
          $photo->save();
        }
      }

      Session::flash('message', 'Your product was successfully created');
      return response()->json([
        'success' => true,
        'message' => "Your product was successfully created"
      ]);
    }

    public function get_all_products(Request $request) {
      $draw = $request->get('draw');
      $start = $request->get("start");
      $rowperpage = $request->get("length"); // total number of rows per page

      $columnIndex_arr = $request->get('order');
      $columnName_arr = $request->get('columns');
      $order_arr = $request->get('order');
      $search_arr = $request->get('search');

      $columnIndex = $columnIndex_arr[0]['column']; // Column index
      $columnName = $columnName_arr[$columnIndex]['data']; // Column name
      $columnSortOrder = $order_arr[0]['dir']; // asc or desc
      $searchValue = $search_arr['value']; // Search value

      $searchByFromdate = $request->get('searchByFromdate');
      $searchByTodate = $request->get('searchByTodate');

      if($searchByFromdate == null) {
        $searchByFromdate = '0-0-0 00:00:00';
      }
      if($searchByTodate == null) {
        $searchByTodate = Carbon::now();
      }

      $totalRecords = Product::select('count(*) as allcount')
                      ->where(function ($query) use ($searchValue) {
                        $query->where('brand_code', 'like', '%' . $searchValue . '%')
                            ->orWhere('name', 'like', '%' . $searchValue . '%')
                            ->orWhere('customize_price', 'like', '%' . $searchValue . '%')
                            ->orWhere('s_price', 'like', '%' . $searchValue . '%')
                            ->orWhere('m_price', 'like', '%' . $searchValue . '%')
                            ->orWhere('l_price', 'like', '%' . $searchValue . '%')
                            ->orWhere('xl_price', 'like', '%' . $searchValue . '%')
                            ->orWhere('xxl_price', 'like', '%' . $searchValue . '%')
                            ->orWhere('short_desc', 'like', '%' . $searchValue . '%')
                            ->orWhere('description', 'like', '%' . $searchValue . '%');
                      })
                      ->whereBetween('created_at', [$searchByFromdate, $searchByTodate])->count();
      $totalRecordswithFilter = $totalRecords;

      $records = Product::orderBy($columnName, $columnSortOrder)
          ->orderBy('created_at', 'desc')
          ->where(function ($query) use ($searchValue) {
              $query->where('brand_code', 'like', '%' . $searchValue . '%')
                  ->orWhere('name', 'like', '%' . $searchValue . '%')
                  ->orWhere('customize_price', 'like', '%' . $searchValue . '%')
                  ->orWhere('s_price', 'like', '%' . $searchValue . '%')
                  ->orWhere('m_price', 'like', '%' . $searchValue . '%')
                  ->orWhere('l_price', 'like', '%' . $searchValue . '%')
                  ->orWhere('xl_price', 'like', '%' . $searchValue . '%')
                  ->orWhere('xxl_price', 'like', '%' . $searchValue . '%')
                  ->orWhere('short_desc', 'like', '%' . $searchValue . '%')
                  ->orWhere('description', 'like', '%' . $searchValue . '%');
          })
          ->whereBetween('created_at', [$searchByFromdate, $searchByTodate])
          ->select('products.*')
          ->skip($start)
          ->take($rowperpage)
          ->get();

      $data_arr = array();

      foreach ($records as $record) {
          $data_arr[] = array(
              "brand_code" => $record->brand_code,
              "name" => $record->name,
              "product_image" => $record->getProductPhotos[0]->product_image,
              "price" => $record->customize_price ? $record->customize_price : $record->s_price . ' - ' . $record->xxl_price,
              "created_at" => date('F d, Y', strtotime($record->created_at)),
              "id" => $record->id,
          );
      }

      $response = array(
          "draw" => intval($draw),
          "iTotalRecords" => $totalRecords,
          "iTotalDisplayRecords" => $totalRecordswithFilter,
          "aaData" => $data_arr,
      );
      echo json_encode($response);
    }

    public function edit($id) {
      $data=Product::where('id',$id)->first();
      $colors = Color::orderBy('name', 'asc')->get();
      return view('backend.products.edit',['data'=>$data, 'colors' => $colors]);
    }

    public function update(Request $request, $id) {
      $request->validate([
        'type'=>['required'],
      ]);
      if(in_array('readytowear', $request->type)) {
        $request->validate([
          'name'=>['required','max:1000'],
          'type'=>['required'],
          's_price'=>['required','integer'],
          'm_price'=>['required','integer'],
          'l_price'=>['required','integer'],
          'xl_price'=>['required','integer'],
          'xxl_price'=>['required','integer'],
          'brand_code'=>['required','max:1000'],
          'short_desc'=>['required'],
          'description'=>['required']
        ]);
      }
      if(in_array('customize', $request->type)) {
        $request->validate([
          'name'=>['required','max:1000'],
          'type'=>['required'],
          'customize_price'=>['required','integer'],
          'brand_code'=>['required','max:1000'],
          'short_desc'=>['required'],
          'description'=>['required']
        ]);
      }

      $product = Product::findOrFail($id);
      $product->name = $request->name;
      $product->customize_price = $request->customize_price;
      $product->s_price = $request->s_price;
      $product->m_price = $request->m_price;
      $product->l_price = $request->l_price;
      $product->xl_price = $request->xl_price;
      $product->xxl_price = $request->xxl_price;
      $product->brand_code = $request->brand_code;
      $product->category_id = $request->category_id;
      $product->short_desc = $request->short_desc;
      $product->description = $request->description;
      $product->type = json_encode($request->type);
      $product->color = $request->color;
      $product->save();

      $folderPath = 'images/products/';
      $get_ptroduct_id = ProductPhoto::where('product_id', $product->id)->get();

      if($request->product_image){
           
        foreach($get_ptroduct_id as $id){
          if($id->product_image){
            if(File::exists(public_path($id->product_image))){
              File::delete(public_path($id->product_image));
            }
          }
          $id->ForceDelete();
        }

        foreach($request->product_image as $re){
          $product_photo = new ProductPhoto();
          $product_photo->product_id = $product->id;
          $image_parts = explode(";base64,", $re);
          $image_type_aux = explode("image/", $image_parts[0]);
          // $image_type = $image_type_aux[1];
          $image_base64 = base64_decode($image_parts[1]);
    
          $imageName = uniqid().'_product' . '.png';
    
          $imageFullPath = public_path($folderPath.$imageName);
  
          file_put_contents($imageFullPath, $image_base64);
          $product_photo->product_image = $folderPath.$imageName;
          $product_photo->save(); 
        }
      }
      Session::flash('message', 'Your product was successfully edited');

      return response()->json([
        'success' => true,
        'message' => "Product Update Success"
      ]);

    }

    public function destroy($id)
    {
      Product::findOrFail($id)->delete();
      
      Addtocart::where('product_id', $id)->delete();
      OrderDressCustomize::where('product_id', $id)->whereNull('payment_id')->delete();
      OrderSuitCustomize::where('product_id', $id)->whereNull('payment_id')->delete();

      Session::flash('message', 'Your product was successfully deleted');
      return redirect(url('backend/product/list'));
    }
    
    public function trash() {
      $products = Product::onlyTrashed()->orderBy('deleted_at', 'desc')->get();
      return view('backend.products.trash',['products' => $products]);
    }

    public function restore($id) {
      Product::onlyTrashed()->find($id)->restore();
      Session::flash('message', 'Your product was successfully restored');
      return redirect(url('backend/product/list'));   
    }

    public function forceDelete($id) {
      $photo = ProductPhoto::where('product_id',$id)->get();
      foreach($photo as $f){
        if($f->product_image){
          if(File::exists(public_path($f->product_image))){
            File::delete(public_path($f->product_image));
          }
        }
        $f->delete();
      }
      Product::onlyTrashed()->find($id)->forceDelete();
      Session::flash('message', 'Your product was successfully deleted.');
      return redirect(url('backend/product/list'));
    }
}
