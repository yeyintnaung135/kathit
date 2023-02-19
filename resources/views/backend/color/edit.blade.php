@extends('layouts.backend.layout')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <x-minibackheader :maintext="'Edit color'" :subtext="'Edit color'"/>
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">

                    <div class="col-md-6">
                        <!-- general form elements -->
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Edit Color</h3>
                            </div>
                            <!-- form start -->
                            <form method="post" action="{{url('backend/color/update/'.$color->id)}}" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="card-body">
                                    <input type="hidden" name="id" value="{{$color->id}}"/>
                                    <div class="col-12 pr-0 pr-md-2 mb-3">
                                      <label for="exampleInputEmail1">Name
                                          @error('name')
  
                                          <span
                                              style="color:red;font-size:13px;font-weight:bold;">{{ $message }}</span>
  
                                          @enderror
                                      </label>
                                      <input type="text" name="name"
                                             class="form-control  @error('name') is-invalid @enderror "
                                             id="exampleInputEmail1" value="{{old('name',$color->name)}}"
                                             placeholder="Enter Color Name" required
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
                                             id="exampleInputEmail1" value="{{old('code',$color->code)}}"
                                             placeholder="Choose color code" required
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
