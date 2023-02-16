<?php

namespace App\Http\Controllers\backend;

use App\Models\Contact;

use App\Admins;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Carbon;

class ContactController extends Controller
{
  public function __construct() {
    $this->middleware('auth:admins');
  }

  public function edit() {
    $contact = Contact::first();
    return view('backend.contact_us.edit',['contact'=>$contact]);
  }

  public function update(Request $request, $id) {
    $input=$request->except('_token');
    $contact=Contact::where('id',$id)->first();
    $validator=Validator::make($input,[
      'address'=>['required'],
      'phone'=>['required'],
      'email'=>['required'],
    ]);
    if ($validator->fails()) {
      return redirect()->back()->withErrors($validator)->withInput();
    }
    Contact::where('id',$id)->update([
      'address'=>$input['address'],
      'phone'=>$input['phone'],
      'email'=>$input['email']
    ]);
    Session::flash('message', 'Your contact information was successfully updated');
    return redirect(url('/backend/contact/edit'));
  }
}