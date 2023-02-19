<?php

namespace App\Http\Controllers\backend;

use App\Models\Color;

use App\Admins;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Carbon;

class ColorController extends Controller
{
  public function __construct() {
    $this->middleware('auth:admins');
  }

  public function index() {
    $colors = Color::latest()->get();
    return view('backend.color.list',['colors'=>$colors]);
  }

  public function create() {
    return view('backend.color.create');
  }

  public function store(Request $request) {
    $input=$request->except('_token');

    $validator=Validator::make($input,[
      'name'=>['required','unique:product_colors','max:1000'],
      'code'=>['required','max:1000']
    ]);
    if($validator->fails()){
        return redirect()->back()->withErrors($validator)->withInput();
    }
    
    Color::create($input);
    Session::flash('message', 'Your video was successfully created');

    return redirect(url('backend/color/list'));
  }

  public function edit($id) {
    $color = Color::findOrFail($id);
    return view('backend.color.edit',compact('color'));
  }

  public function update(Request $request, $id){
    $input=$request->except('_token');
    $color = Color::findOrFail($id);
    $validator=Validator::make($input,[
      'name'=>['required','max:1000'],
      'code'=>['required','max:1000']
    ]);
    if($validator->fails()){
      return redirect()->back()->withErrors($validator)->withInput();
    }
    Color::where('id',$input['id'])->update([
      'name'=>$input['name'],
      'code'=>$input['code']
      ]);

    return redirect(url('backend/color/list'));
  }

  public function delete($id) {
    $color = Color::findOrFail($id);
    $color->delete();
    Session::flash('message', 'Your color was successfully deleted');
    return redirect()->back();
  }
}