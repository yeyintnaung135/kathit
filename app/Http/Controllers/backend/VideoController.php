<?php

namespace App\Http\Controllers\backend;

use App\Models\Video;

use App\Admins;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Carbon;

class VideoController extends Controller
{
  public function __construct() {
    $this->middleware('auth:admins');
  }

  public function index() {
    $videos = Video::latest()->get();
    return view('backend.video.list',['videos'=>$videos]);
  }

  public function create() {
    return view('backend.video.create');
  }

  public function store(Request $request) {
    $input=$request->except('_token');

    $validator=Validator::make($input,[
      'title'=>['required','max:1000'],
      'video'=>['required',
                'url',
                function ($attribute, $requesturl, $failed) {
                    if (!preg_match('/(youtube.com|youtu.be)\/(embed)?(\?v=)?(\S+)?/', $requesturl)) {
                        $failed(trans("general.not_youtube_url", ["name" => trans("general.url")]));
                    }
                },]
    ]);
    if($validator->fails()){
        return redirect()->back()->withErrors($validator)->withInput();
    }
    
    Video::create($input);
    Session::flash('message', 'Your video was successfully created');

    return redirect(url('backend/video/list'));
  }

  public function edit($id) {
    $video = Video::findOrFail($id);
    return view('backend.video.edit',compact('video'));
  }

  public function update(Request $request, $id){
    $input=$request->except('_token');
    $video = Video::findOrFail($id);
    $validator=Validator::make($input,[
      'title'=>['required','max:1000'],
      'video'=>['required',
                'url',
                function ($attribute, $requesturl, $failed) {
                    if (!preg_match('/(youtube.com|youtu.be)\/(embed)?(\?v=)?(\S+)?/', $requesturl)) {
                        $failed(trans("general.not_youtube_url", ["name" => trans("general.url")]));
                    }
                },]
    ]);
    if($validator->fails()){
        return redirect()->back()->withErrors($validator)->withInput();
    }
    Video::where('id',$input['id'])->update([
      'title'=>$input['title'],
      'video'=>$input['video']
      ]);

    return redirect(url('backend/video/list'));
  }

  public function delete($id) {
    $video = Video::findOrFail($id);
    $video->delete();
    Session::flash('message', 'Your video was successfully deleted');
    return redirect()->back();
  }
}