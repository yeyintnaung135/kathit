<?php

namespace App\Http\Controllers\backend;

use App\Models\Product;
use App\Models\Color;

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
      // dd($request);
      $input=$request->except('_token');

      $validator=Validator::make($input,[
          'name'=>['required','max:1000'],
          'product_image'=>['required','mimes:jpeg,bmp,png,jpg'],
          'price'=>['required','integer'],
          'short_desc'=>['required'],
          'description'=>['required']
      ]);
      if($validator->fails()){
          return redirect()->back()->withErrors($validator)->withInput();
      }

      $img = $input['product_image'];

      $imageNameone = time().'img'.'.'.$img->getClientOriginalExtension();

      $lpath=$img->move(public_path('images/products/'),$imageNameone);
      $input['product_image']='images/products/'.$imageNameone;
      Product::create($input);

      Session::flash('message', 'Your product was successfully created');

      return redirect(url('backend/product/list'));
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
                        $query->where('id', 'like', '%' . $searchValue . '%')
                            ->orWhere('name', 'like', '%' . $searchValue . '%')
                            ->orWhere('price', 'like', '%' . $searchValue . '%')
                            ->orWhere('short_desc', 'like', '%' . $searchValue . '%')
                            ->orWhere('description', 'like', '%' . $searchValue . '%');
                      })
                      ->whereBetween('created_at', [$searchByFromdate, $searchByTodate])->count();
      $totalRecordswithFilter = $totalRecords;

      $records = Product::orderBy($columnName, $columnSortOrder)
          ->orderBy('created_at', 'desc')
          ->where(function ($query) use ($searchValue) {
              $query->where('id', 'like', '%' . $searchValue . '%')
                  ->orWhere('name', 'like', '%' . $searchValue . '%')
                  ->orWhere('price', 'like', '%' . $searchValue . '%')
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
              "id" => $record->id,
              "name" => $record->name,
              "product_image" => $record->product_image,
              "price" => $record->price,
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

    public function update(Request $request) {
      $input=$request->except('_token');
      $product=Product::where('id',$input['id'])->first();
      $validator=Validator::make($input,[
        'name'=>['required','max:1000'],
        'price'=>['required','integer']
      ]);
      if($validator->fails()){
        return redirect()->back()->withErrors($validator)->withInput();
      }
      if($request->file('product_image')) {
        if (File::exists(public_path($product->product_image))) {
          File::delete(public_path($product->product_image));
        }
        $img = $input['product_image'];

        $imageNameone = time().'img'.'.'.$img->getClientOriginalExtension();

        $lpath=$img->move(public_path('images/products/'),$imageNameone);
        $input['product_image']='images/products/'.$imageNameone;
      } else {
        $input['product_image'] = $product->product_image;
      }
      Product::where('id',$input['id'])->update([
        'name'=>$input['name'],
        'product_image'=>$input['product_image'],
        'price'=>$input['price'],
        'category_id'=>$input['category_id'],
        'type'=>$input['type'],
        'color'=>$input['color'],
        'short_desc'=>$input['short_desc'],
        'description'=>$input['description']
      ]);
      Session::flash('message', 'Your product was successfully edited');

      return redirect(url('backend/product/list'));

    }

    public function destroy($id)
    {
      Product::findOrFail($id)->delete();
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
      Product::onlyTrashed()->find($id)->forceDelete();
      Session::flash('message', 'Your product was successfully deleted.');
      return redirect(url('backend/product/list'));
    }
}
