@extends('layouts.backend.layout')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <x-minibackheader :maintext="'Add new color'" :subtext="'add new color'"/>
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">

                    <div class="col-md-6">
                        <!-- general form elements -->
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">New Color</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form method="post" action="{{url('backend/color/store')}}" enctype="multipart/form-data">
                                @csrf
                                <div class="card-body">
                                  <div class="col-12 pr-0 pr-md-2">
                                    <label for="exampleInputEmail1">Color Name
                                        @error('name')

                                        <span
                                            style="color:red;font-size:13px;font-weight:bold;">{{ $message }}</span>

                                        @enderror
                                    </label>
                                    <input type="text" name="name"
                                           class="form-control  @error('name') is-invalid @enderror "
                                           id="exampleInputEmail1" value="{{old('name')}}"
                                           placeholder="Enter color name" required
                                    >

                                  </div>

                                  <div class="col-12 pr-0 pr-md-2">
                                    <label for="exampleInputEmail1">Color Code
                                        @error('code')

                                        <span
                                            style="color:red;font-size:13px;font-weight:bold;">{{ $message }}</span>

                                        @enderror
                                    </label>
                                    <input type="text" name="code"
                                           class="form-control  @error('code') is-invalid @enderror colorpicker"
                                           id="exampleInputEmail1" value="{{old('code')}}"
                                           placeholder="Choose color code" required autocomplete="off"
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
@push('styles')
  <style>
    .colorpicker {
      box-sizing: border-box !important;
    }
  </style>
@endpush
@push('scripts')
<script src="{{url('backend/plugins/bs-custom-file-input/bs-custom-file-input.min.js')}}"></script>

<script>

    $(function () {
      $('.colorpicker').colorpicker();
    });
</script>
@endpush
