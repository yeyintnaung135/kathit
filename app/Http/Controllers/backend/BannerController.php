<?php

namespace App\Http\Controllers\backend;

use App\Models\Banner;

use App\Admins;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Carbon;

class BannerController extends Controller
{
  public function __construct() {
    $this->middleware('auth:admins');
  }

  public function index() {
    $banners = Banner::all();
    return view('backend.banner.list',['banner'=>$banners]);
  }

  public function create() {
    return view('backend.banner.create');
  }

  public function store(Request $request) {
    $input=$request->except('_token');
    $validator=Validator::make($input,[
        'image'=>['required','mimes:jpeg,bmp,png,jpg']
    ]);
    if($validator->fails()){
        return redirect()->back()->withErrors($validator)->withInput();
    }
    $img = $input['image'];

    $imageNameone = time().'img'.'.'.$img->getClientOriginalExtension();

    $lpath=$img->move(public_path('images/banners/'),$imageNameone);
    $input['image']='images/banners/'.$imageNameone;
    Banner::create($input);
    Session::flash('message', 'Your Banner was successfully created');

    return redirect(url('backend/banner/list'));
  }

  public function edit($id) {
    $banner = Banner::findOrFail($id);
    return view('backend.banner.edit',compact('banner'));
  }

  public function update(Request $request, $id){
    $input=$request->except('_token');
    $banner = Banner::findOrFail($id);
    $validator=Validator::make($input,[
        'image'=>['mimes:jpeg,bmp,png,jpg'],
       ]);
    if($validator->fails()){
        return redirect()->back()->withErrors($validator)->withInput();
    }
    if ($request->file('image')){
      if (File::exists(public_path($banner->image))) {
          File::delete(public_path($banner->image));
      }
      $img = $input['image'];

      $imageNameone = time().'img'.'.'.$img->getClientOriginalExtension();

      $lpath=$img->move(public_path('images/banners/'),$imageNameone);
      $input['image']='images/banners/'.$imageNameone;
      Banner::where('id',$input['id'])->update([
          'image'=>$input['image']
          ]);
      Session::flash('message', 'Your Banner was successfully edited');
    }

    return redirect(url('backend/banner/list'));
  }

  public function delete($id) {
    $banner = Banner::findOrFail($id);
    if($banner->image){
        if(File::exists(public_path($banner->image))){
            File::delete(public_path($banner->image));
        }
        $banner->delete();
    }
    Session::flash('message', 'Your Banner was successfully deleted');
    return redirect()->back();
  }
}