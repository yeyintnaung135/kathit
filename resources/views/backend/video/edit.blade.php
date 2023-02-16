@extends('layouts.backend.layout')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <x-minibackheader :maintext="'Edit video'" :subtext="'Edit video'"/>
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">

                    <div class="col-md-6">
                        <!-- general form elements -->
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Edit Video</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="banner">
                              <iframe style="width: 100%;height: 211px;" src="{{ $video->video }}" title="YouTube video player" frameborder="0"
                                  allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                  allowfullscreen>
                              </iframe>
                            </div>
                            <!-- form start -->
                            <form method="post" action="{{url('backend/video/update/'.$video->id)}}" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="card-body">
                                    <input type="hidden" name="id" value="{{$video->id}}"/>
                                    <div class="col-12 pr-0 pr-md-2 mb-3">
                                      <label for="exampleInputEmail1">Title
                                          @error('title')
  
                                          <span
                                              style="color:red;font-size:13px;font-weight:bold;">{{ $message }}</span>
  
                                          @enderror
                                      </label>
                                      <input type="text" name="title"
                                             class="form-control  @error('title') is-invalid @enderror "
                                             id="exampleInputEmail1" value="{{old('title',$video->title)}}"
                                             placeholder="Enter Title" required
                                      >
  
                                    </div>
                                    <div class="col-12 pr-0 pr-md-2">
                                      <label for="exampleInputEmail1">Youtube Video Link
                                          @error('video')
  
                                          <span
                                              style="color:red;font-size:13px;font-weight:bold;">{{ $message }}</span>
  
                                          @enderror
                                      </label>
                                      <input type="text" name="video"
                                             class="form-control  @error('video') is-invalid @enderror "
                                             id="exampleInputEmail1" value="{{old('video',$video->video)}}"
                                             placeholder="Video Link" required
                                      >
  
                                    </div>

                                </div>
                                <!-- /.card-body -->

                                <div class="card-footer float-right">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </form>
                        </div>
                        <!-- /.card -->


                    </div>

                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection
@push('scripts')
    <script src="{{url('backend/plugins/bs-custom-file-input/bs-custom-file-input.min.js')}}"></script>

    <script>

        $(function () {
            bsCustomFileInput.init();
        });
    </script>
@endpush
