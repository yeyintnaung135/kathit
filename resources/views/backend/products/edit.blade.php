@extends('layouts.backend.layout')
@section('title','Kathit | Product Edit')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <x-minibackheader :maintext="'Add new products'" :subtext="'add new products'"/>
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">

                    <div class="col-md-12">
                        <!-- general form elements -->
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">New Products</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form method="post" action="{{url('backend/product/update/'.$data->id)}}" enctype="multipart/form-data">
                              <input type="hidden" name="id" value="{{$data->id}}"/>  
                              @csrf
                                <div class="card-body">
                                    <div class="form-group row no-gutters">
                                        <div class="col-12 col-md-6 pr-0 pr-md-2">
                                            <label for="exampleInputEmail1">Name
                                                @error('name')

                                                <span
                                                    style="color:red;font-size:13px;font-weight:bold;">{{ $message }}</span>

                                                @enderror
                                            </label>
                                            <input type="text" name="name"
                                                   class="form-control  @error('name') is-invalid @enderror "
                                                   id="exampleInputEmail1" value="{{old('name',$data->name)}}"
                                                   placeholder="Enter Name" required
                                            >


                                        </div>
                                        {{-- <div class="col-12 col-md-6">
                                          <label>Product Type</label>
                                          <select class="form-control" name="category_id">
                                              <option value="simple">Simple</option>
                                              <option value="variable">Variable</option>
                                          </select>
                                        </div> --}}
                                    </div>
                                    <div class="form-group row no-gutters">
                                        <div class="col-12 col-md-6 pr-md-2">
                                            <label for="customFile">Product Image
                                                @error('product_image')

                                                <span
                                                    style="color:red;font-size:13px;font-weight:bold;">{{ $message }}</span>

                                                @enderror
                                            </label>

                                            <div class="custom-file">

                                                <input type="file" name="product_image" class="custom-file-input"
                                                      id="customFile">
                                                <label class="custom-file-label" for="customFile">Product Image</label>
                                                @error('product_image')
                                                <span class="invalid-feedback" role="alert">
                                              <strong>{{ $message }}</strong>
                                            </span>
                                                @enderror
                                            </div>
                                        </div>
                                        {{-- <div class="col-12 col-md-6 pr-0">
                                            <label for="customFile"> Product Gallery
                                                @error('photo_one')

                                                <span
                                                    style="color:red;font-size:13px;font-weight:bold;">{{ $message }}</span>

                                                @enderror
                                            </label>

                                            <div class="custom-file">

                                                <input type="file" name="product_gallery" class="custom-file-input"
                                                       id="customFile" multiple>
                                                <label class="custom-file-label" for="customFile">Product Gallery</label>
                                                @error('photo_one')
                                                <span class="invalid-feedback" role="alert">
                                              <strong>{{ $message }}</strong>
                                            </span>
                                                @enderror
                                            </div>
                                        </div> --}}
                                    </div>
                                    <div class="form-group row no-gutters">
                                      <div class="col-12 col-md-6 pr-md-2">
                                          <label for="exampleInputEmail1">Price (Ks)
                                              @error('price')

                                              <span
                                                  style="color:red;font-size:13px;font-weight:bold;">{{ $message }}</span>

                                              @enderror
                                          </label>
                                          <input type="number" name="price"
                                                class="form-control  @error('price') is-invalid @enderror "
                                                id="exampleInputEmail1" value="{{old('price',$data->price)}}"
                                                placeholder="Enter Price" required
                                          >


                                      </div>
                                      <div class="col-12 col-md-6">
                                        <label>Category</label>
                                        <select class="form-control" name="category_id">
                                            <option value="1" {{ $data->category_id == '1' ? 'selected' : '' }}>Dress</option>
                                            <option value="2" {{ $data->category_id == '2' ? 'selected' : '' }}>Myanmar Dress</option>
                                            <option value="3" {{ $data->category_id == '3' ? 'selected' : '' }}>Men's Wear</option>
                                            <option value="4" {{ $data->category_id == '4' ? 'selected' : '' }}>Women's Wear</option>
                                        </select>
                                      </div>
                                    </div>

                                    <div class="form-group">

                                        <section class="content">
                                            <div class="row">

                                                <div class="col-md-12">
                                                    <div class="card card-outline card-info">
                                                        <div class="card-header">
                                                            <h3 class="card-title">
                                                                Short Description
                                                                @error('short_desc')

                                                                <span
                                                                    style="color:red;font-size:13px;font-weight:bold;">{{ $message }}</span>

                                                                @enderror

                                                            </h3>
                                                        </div>
                                                        <!-- /.card-header -->
                                                        <div class="card-body">
                                                         <textarea id="summernote1" name="short_desc" >
                                                          {{old('short_desc',$data->short_desc)}}</textarea>

                                                        </div>

                                                    </div>

                                                </div>
                                                <!-- /.col-->
                                            </div>
                                            <!-- ./row -->
                                            <!-- ./row -->
                                        </section>
                                    </div>

                                    <div class="form-group">

                                        <section class="content">
                                            <div class="row">

                                                <div class="col-md-12">
                                                    <div class="card card-outline card-info">
                                                        <div class="card-header">
                                                            <h3 class="card-title">
                                                                Description
                                                                @error('description')

                                                                <span
                                                                    style="color:red;font-size:13px;font-weight:bold;">{{ $message }}</span>

                                                                @enderror

                                                            </h3>
                                                        </div>
                                                        <!-- /.card-header -->
                                                        <div class="card-body">
                                                         <textarea id="summernote" name="description" >
                                                          {{old('description',$data->description)}}</textarea>

                                                        </div>

                                                    </div>

                                                </div>
                                                <!-- /.col-->
                                            </div>
                                            <!-- ./row -->
                                            <!-- ./row -->
                                        </section>
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
            // Summernote
            $('#summernote').summernote({
                height: 300,

                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'italic', 'underline', 'clear']],
                    ['fontname', ['fontname']],
                    ['fontsize', ['fontsize']],

                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['height', ['height']],
                    ['table', ['table']],
                    ['insert', ['link', 'picture', 'hr']],
                    ['view', ['fullscreen', 'codeview']],
                    ['help', ['help']],


                ]

            });
            $('#summernote1').summernote({
                height: 300,

                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'italic', 'underline', 'clear']],
                    ['fontname', ['fontname']],
                    ['fontsize', ['fontsize']],

                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['height', ['height']],
                    ['table', ['table']],
                    ['insert', ['link', 'picture', 'hr']],
                    ['view', ['fullscreen', 'codeview']],
                    ['help', ['help']],


                ]

            })

            // CodeMirror
            CodeMirror.fromTextArea(document.getElementById("codeMirrorDemo"), {
                mode: "htmlmixed",
                theme: "monokai"
            });
        })
    </script>

    <script>

        $(function () {
            bsCustomFileInput.init();
        });
    </script>
@endpush
