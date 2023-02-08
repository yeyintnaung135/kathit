@extends('layouts.backend.layout')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <x-minibackheader :maintext="'Edit banner'" :subtext="'Edit banner'"/>
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">

                    <div class="col-md-6">
                        <!-- general form elements -->
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Edit Banner</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="banner mb-5">
                              <img src="{{ asset($banner->image)}}" alt="" class="w-100">
                            </div>
                            <!-- form start -->
                            <form method="post" action="{{url('backend/banner/update/'.$banner->id)}}" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="card-body">
                                    <input type="hidden" name="id" value="{{$banner->id}}"/>
                                    <div class="custom-file">
                                        <input type="file" name="image" class="custom-file-input"
                                               id="customFile" >
                                        <label class="custom-file-label" for="customFile">Photo</label>

                                    </div>
                                    @error('image')
                                    <span style="font-size: 15px;color:red;">
                                              <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror

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
